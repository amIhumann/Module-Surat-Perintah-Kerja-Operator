<?php

namespace App\Http\Controllers;

use App\Models\Spko;
use App\Models\Employee;
use App\Models\Product;
use App\Models\Spko_item;

use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;

class SpkoController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get spkos
        $spkos = Spko::selectRaw("
        spkos.id,
        CONCAT(
            'SPKO', 
            RIGHT(YEAR(spkos.trans_date), 2), 
            LPAD(MONTH(spkos.trans_date),2,'0'),
            LPAD(spkos.id,3,'0')
        ) as no_spko, 
        employees.nama as operator, 
        spkos.trans_date, 
        spkos.process, 
        spkos.sw,
        spkos.remarks")->join('employees', 'employees.id', '=', 'spkos.employee')->get();

        //render view with spkos
        return view('spkos.index', compact('spkos'));
    }

    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        $employees = Employee::all();
        $products = Product::all();

        return view('spkos.create', compact('employees', 'products'));
    }

    /**
     * store
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        //validate form
        $this->validate($request, [
            'employee'      =>  'required|max:11',
            'trans_date'    =>  'required',
            'process'       =>  'required|max:10',
            'sw'            =>  'required|max:25',
            'remarks'       =>  'required|max:25'
        ]);

        //create spko
        $id_spko = Spko::create([
            'employee'      => $request->employee,
            'trans_date'    => $request->trans_date,
            'process'       => $request->process,
            'sw'            => $request->sw,
            'remarks'       => $request->remarks
        ])->id;

        for ($i=0; $i < count($request->product) ; $i++) { 
            Spko_item::create([
                'idm'           => ($i + 1),
                'ordinal'       => $id_spko,
                'id_product'    => $request->product[$i],
                'qty'           => $request->qty[$i]
            ]);
        }

        //redirect to index
        return redirect()->route('spkos.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    
    /**
     * edit
     *
     * @param  mixed $spko
     * @return void
     */
    public function edit(Spko $spko)
    {
        $employees = Employee::all();
        $products = Product::all();
        
        //Show spko_items
        $spko_items = Spko_item::where('spko_items.ordinal', $spko->id)->selectRaw("
        products.description,
        products.carat,
        CONCAT(
            products.sub_category,
            '.', 
            products.serial_no,
            '.', 
            LEFT(products.carat, 2), 
            '.', 
            LPAD(spko_items.ordinal,2,'0')
        ) as sku,
        spko_items.qty")->join('products', 'products.id', '=', 'spko_items.id_product')->get();

        return view('spkos.edit', compact('spko', 'employees', 'products', 'spko_items'));
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $spko
     * @return void
     */
    public function update(Request $request, Spko $spko)
    {
        //validate form
        $this->validate($request, [
            'employee'      =>  'required|max:11',
            'trans_date'    =>  'required',
            'process'       =>  'required|max:10',
            'sw'            =>  'required|max:25',
            'remarks'       =>  'required|max:25'
        ]);


        //update spko
        $spko->update([
            'employee'      => $request->employee,
            'trans_date'    => $request->trans_date,
            'process'       => $request->process,
            'sw'            => $request->sw,
            'remarks'       => $request->remarks
        ]);

        $spko_item = Spko_item::where('ordinal', $spko->id)->delete();

        if ($spko_item) {
            for ($i=0; $i < count($request->product) ; $i++) { 
                Spko_item::create([
                    'idm'           => ($i + 1),
                    'ordinal'       => $spko->id,
                    'id_product'    => $request->product[$i],
                    'qty'           => $request->qty[$i]
                ]);
            }
        }

        //redirect to index
        return redirect()->route('spkos.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * destroy
     *
     * @param  mixed $spko
     * @return void
     */
    public function destroy(Spko $spko)
    {

        //delete spko
        $spko->delete();
        $spko_item = Spko_item::where('ordinal', $spko->id)->delete();

        //redirect to index
        return redirect()->route('spkos.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    
    /**
     * print_out
     *
     * @param
     * @return void
     */
    public function print_out($spko_id)
    {
        //Show Spko
        $spko = Spko::where('spkos.id', $spko_id)->selectRaw("
        spkos.id,
        employees.id as id_operator,
        CONCAT(
            'SPKO', 
            RIGHT(YEAR(spkos.trans_date), 2), 
            LPAD(MONTH(spkos.trans_date),2,'0'),
            LPAD(spkos.id,3,'0')
        ) as no_spko, 
        employees.nama as operator, 
        DATE_FORMAT(spkos.trans_date, '%d %M %Y %H:%i:%s') as trans_date, 
        spkos.process, 
        spkos.sw,
        spkos.remarks")->join('employees', 'employees.id', '=', 'spkos.employee')->first();

        //Show spko_items
        $spko_items = Spko_item::where('spko_items.ordinal', $spko_id)->selectRaw("
        products.description,
        products.carat,
        CONCAT(
            products.sub_category,
            '.', 
            products.serial_no,
            '.', 
            LEFT(products.carat, 2), 
            '.', 
            LPAD(spko_items.ordinal,2,'0')
        ) as sku,
        spko_items.qty")->join('products', 'products.id', '=', 'spko_items.id_product')->get();
 
    	$pdf = PDF::loadview('spkos.print_out', compact('spko', 'spko_items'));
    	return $pdf->download($spko->no_spko . '.pdf');
    }
}
