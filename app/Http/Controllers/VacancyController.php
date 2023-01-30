<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Vacancy;
use App\Models\Employer;
use App\Models\TypeVacancy;
use Illuminate\Http\Request;
use App\Models\StatusVacancy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\VacancyStoreRequest;
use App\Http\Requests\VacancyUpdateRequest;

class VacancyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        try{

        $employerId = Auth::user()->userable_id; 
        $vacancies = null ;   
        $status = StatusVacancy::get();
        $types = TypeVacancy::get();   

    
        if(isset($request->status) || isset($request->search) || isset($request->type) ){

            if($request->status != 0 && empty($request->search) && ($request->type == 0 || $request->type == "")  ){            
                
                $vacancies = Vacancy::with(['employer','status','type'])
                ->where('employer_id','=',$employerId)   
                ->WhereRelation('status','id',"=",$request->status)              
               ->paginate(20);      
            
               
             }
             elseif($request->search != "" && ($request->status == 0 || $request->status == "") && ($request->type == 0 || $request->type == "") ){
                
                $vacancies = Vacancy::with(['employer','status','type'])
                ->where('employer_id','=',$employerId)   
                ->where("title","LIKE","%{$request->search}%")
                ->orWhereRelation('employer','trade',"LIKE","%{$request->search}%")              
                ->paginate(20);      

             }
             elseif($request->type != 0 && empty($request->search) && ($request->status == 0 || $request->status == "")  ){            
                
                $vacancies = Vacancy::with(['employer','status','type'])
                ->where('employer_id','=',$employerId)   
                ->WhereRelation('type','id',"=",$request->type)              
               ->paginate(20);      
                           
             }


             else{

                $vacancies = Vacancy::with(['employer','status','type'])
                ->where('employer_id','=',$employerId)   
                ->where("title","LIKE","%{$request->search}%")
                ->orWhereRelation('status','name',"=",$request->status)              
                ->paginate(20);      
             }
       
        
        }else{
            $vacancies = Vacancy::where("title","LIKE","%{$request->search}%")
            ->where('employer_id','=',$employerId)
           ->paginate(20);
              

        }

           
 
         return view('Vacancy.index',['vacancies'=>$vacancies,'status'=>$status,'types'=>$types]);

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
       try{
        $types = TypeVacancy::all();
        return view('Vacancy.create',['types'=>$types]);

    }catch (Throwable $e) {
        report($e);
        
        return Redirect::back()->with('error', 'Ocorreu um erro inesperado, tente novamente');
    }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VacancyStoreRequest $request)
    {
        try {

       $employerId = Auth::user()->userable_id;

        $vacancy = Vacancy::create([
            'title'=>$request->title,
           'description'=>$request->description,
           'requirement'=>$request->requirement,
           'employer_id'=>$employerId,
           'status_id'=>1,
           'type_id'=>$request->type
            ]);
    
            if(!$vacancy){
                return Redirect::back()->with('error', 'Ocorreu um erro ao cadastrar');
              }
              
                return Redirect::to('/vacancy');

         
            }catch (Throwable $e) {
                report($e);
                
                return Redirect::back()->with('error', 'Ocorreu um erro inesperado, tente novamente');
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vacancy  $vacancy
     * @return \Illuminate\Http\Response
     */
    public function show(Vacancy $vacancy)
    {
        try{
        if(!$vacancy){
            return Redirect::to('/applicant');
           }
         

           return view('Vacancy.show',['vacancy'=>$vacancy]);
      
        }catch (Throwable $e) {
            report($e);
            
            return Redirect::back()->with('error', 'Ocorreu um erro inesperado, tente novamente');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vacancy  $vacancy
     * @return \Illuminate\Http\Response
     */
    public function edit(Vacancy $vacancy)
    {
        try {

        if(!$vacancy){
            return Redirect::to('/vacancy');
           }
           $types = TypeVacancy::all();  
           $status = StatusVacancy::all();  

           return view('Vacancy.edit',['vacancy'=>$vacancy,'types'=>$types,'status'=>$status]);

        }catch (Throwable $e) {
            report($e);
            
            return Redirect::back()->with('error', 'Ocorreu um erro inesperado, tente novamente');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vacancy  $vacancy
     * @return \Illuminate\Http\Response
     */
    public function update(VacancyUpdateRequest $request, Vacancy $vacancy)
    {
        try {
    
            if(!$vacancy){
            return Redirect::to('/vacancy');
           }

       $vacancy->update([       
        'title'=>$request->title,
           'description'=>$request->description,
           'requirement'=>$request->requirement,          
           'status_id'=>$request->status,
           'type_id'=>$request->type
       ]);
     
 
     
     return view('Vacancy.show',['vacancy'=>$vacancy]);

    }catch (Throwable $e) {
        report($e);
        
        return Redirect::back()->with('error', 'Ocorreu um erro inesperado, tente novamente');
    }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vacancy  $vacancy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vacancy $vacancy)
    {
        try {

        if(!$vacancy){
            return  response()->json(['status'=>false,'message'=>'Ocorreu um erro ao deletar']);
          }
    
            $result = $vacancy->delete();
    
            if(!$result){
              return  response()->json(['status'=>false,'message'=>'Ocorreu um erro ao deletar']);
            }
    
            return  response()->json(['status'=>true,'message'=>'Vaga deletada com sucesso']);

        }catch (Throwable $e) {
            report($e);
            return  response()->json(['status'=>false,'message'=>'Ocorreu um erro inesperado, tente novamente']);
        }
    }


    
    public function catalog(){

        try {

        
        $applicantId = Auth::user()->userable_id;

        $vacancies = Vacancy::with(['status','employer','type'])
        ->whereRelation('status','name','!=','Desativo')
        ->whereDoesntHave('applicants', function($query) use ($applicantId){
            return $query->where('applicants_vacancies.applicant_id','=', $applicantId);
        })
        ->paginate(20);
 
         return view('Vacancy.catalog',['vacancies'=>$vacancies]);

        }catch (Throwable $e) {
            report($e);
            
            return Redirect::back()->with('error', 'Ocorreu um erro inesperado, tente novamente');
        }

    }




    public function subscribeVacancy(Vacancy $vacancy){
       
        try {
       $applicantId = Auth::user()->userable_id;       
       
       $vacancy->applicants()->attach(          
                $applicantId  
        );
      
          return  response()->json(['status'=>true,'message'=>'Vaga aplicada com sucesso']);


        }catch (Throwable $e) {
            report($e);
            return  response()->json(['status'=>true,'message'=>'Ocorreu um erro inesperado, tente novamente']);
        }
      
    }

      
    public function unsubscribeVacancy(Vacancy $vacancy){

        try {

        $applicantId = Auth::user()->userable_id;       

        $vacancy->applicants()->detach(          
            $applicantId  
    );
  
      return  response()->json(['status'=>true,'message'=>'Desinscrição feita com sucesso']);

    }catch (Throwable $e) {
        report($e);
        return  response()->json(['status'=>true,'message'=>'Ocorreu um erro inesperado, tente novamente']);
    }

    }


    public function all(Request $request)
    {
        try {

       
        $vacancies = null ;   
        $status = StatusVacancy::get();
        $types = TypeVacancy::get();   

    
        if(isset($request->status) || isset($request->search) || isset($request->type) ){

            if($request->status != 0 && empty($request->search) && ($request->type == 0 || $request->type == "")  ){            
                
                $vacancies = Vacancy::with(['employer','status','type'])
                ->WhereRelation('status','id',"=",$request->status)              
               ->paginate(20);      
            
               
             }
             elseif($request->search != "" && ($request->status == 0 || $request->status == "") && ($request->type == 0 || $request->type == "") ){
                
                $vacancies = Vacancy::with(['employer','status','type'])
                ->where("title","LIKE","%{$request->search}%")
                ->orWhereRelation('employer','trade',"LIKE","%{$request->search}%")              
                ->paginate(20);      

             }
             elseif($request->type != 0 && empty($request->search) && ($request->status == 0 || $request->status == "")  ){            
                
                $vacancies = Vacancy::with(['employer','status','type'])
                ->WhereRelation('type','id',"=",$request->type)              
               ->paginate(20);      
                           
             }


             else{

                $vacancies = Vacancy::with(['employer','status','type'])
                ->where("title","LIKE","%{$request->search}%")
                ->orWhereRelation('status','name',"=",$request->status)              
                ->paginate(20);      
             }
       
        
        }else{
            $vacancies = Vacancy::where("title","LIKE","%{$request->search}%")
           ->paginate(20);
              

        }

           
 
         return view('Vacancy.index',['vacancies'=>$vacancies,'status'=>$status,'types'=>$types]);

     
        }catch (Throwable $e) {
            report($e);
            
            return Redirect::back()->with('error', 'Ocorreu um erro inesperado, tente novamente');
        }
     
    }

   
}
