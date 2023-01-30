<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\EmployerStoreRequest;
use App\Http\Requests\EmployerUpdateRequest;

class EmployerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    try {

        $employer = Employer::where("trade","LIKE","%{$request->search}%")
        ->orWhere("ein","=",$request->search)
        ->paginate(20);
 
         return view('Employer.index',['employer'=>$employer]);

        }catch (Throwable $e) {
            report($e);
            
            return Redirect::back()->with('error', 'Ocorreu um erro inesperado, tente novamente');
        }
     
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Employer.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployerStoreRequest $request)
    {
        try{

        $employer = Employer::create([
            'trade'=>$request->trade,
            'ein'=>$request->ein
        ]);

        if(!$employer){
            return Redirect::back()->with('error', 'Ocorreu um erro ao cadastrar');
          }

          $user =  $employer->user()->create([
            'name' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)    
          
        ]);

        if (!$user) {
            return Redirect::back()->with('error', 'Ocorreu um erro ao cadastrar');
        }

         
            return Redirect::to('/employer');

        }catch (Throwable $e) {
            report($e);
            
            return Redirect::back()->with('error', 'Ocorreu um erro inesperado, tente novamente');
        }
    

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function show(Employer $employer)
    {
        try{
        
        if(!$employer){
            return Redirect::to('/dashboard');
           }
    
           return view('Employer.show',['employer'=>$employer]);

        }catch (Throwable $e) {
            report($e);
            
            return Redirect::back()->with('error', 'Ocorreu um erro inesperado, tente novamente');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function edit(Employer $employer)
    {
        try{

        if(!$employer){
            return Redirect::to('/employer');
           }
    
           return view('Employer.edit',['employer'=>$employer]);

        }catch (Throwable $e) {
            report($e);
            
            return Redirect::back()->with('error', 'Ocorreu um erro inesperado, tente novamente');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function update(EmployerUpdateRequest $request, Employer $employer)
    {
        try{
        if(!$employer){
            return Redirect::to('/employer');
           }

       $employer->update([       
        'trade'=>$request->trade,
        'ein'=>$request->ein,       
       ]);
     
      
     return view('Employer.show',['employer'=>$employer]);

    }catch (Throwable $e) {
        report($e);
        
        return Redirect::back()->with('error', 'Ocorreu um erro inesperado, tente novamente');
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employer $employer)
      {
        try{
        if(!$employer){
            return  response()->json(['status'=>false,'message'=>'Ocorreu um erro ao deletar']);
          }
    
            $result = $employer->delete();
    
            if(!$result){
              return  response()->json(['status'=>false,'message'=>'Ocorreu um erro ao deletar']);
            }
    
            return  response()->json(['status'=>true,'message'=>'Empregador deletado com sucesso']);
       
        }catch (Throwable $e) {
            report($e);            
            return  response()->json(['status'=>false,'message'=>'Ocorreu um erro inesperado, tente novamente']);

        }
    
    }
}
