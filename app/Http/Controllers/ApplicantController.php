<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\User;
use App\Models\Applicant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ApplicantStoreRequest;
use App\Http\Requests\ApplicantUpdateRequest;

class ApplicantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try{

       
            $applicant = Applicant::where("name","LIKE","%{$request->search}%")
        ->orWhere("itin","=",$request->search)
        ->paginate(20);
 
         return view('Applicant.index',['applicant'=>$applicant]);

        
        
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
        return view('Applicant.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApplicantStoreRequest $request)
    {
        try{

        $photo = null;

        if ($request->hasFile('photo')) {            
        
            $photo = $this->savePhoto($request);
       
        }
       
              
        $applicant = Applicant::create([
        'itin'=>$request->itin,
       'name'=>$request->name,
       'gender'=>$request->gender,
       'age'=>$request->age,
       'photo'=>$photo,
        ]);

        if(!$applicant){
            return Redirect::back()->with('error', 'Ocorreu um erro ao cadastrar');
          }


          $user =  $applicant->user()->create([
            'name' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)    
          
        ]);

        if (!$user) {
            return Redirect::back()->with('error', 'Ocorreu um erro ao cadastrar');
        }
          
            return Redirect::to('/applicant');

        }catch (Throwable $e) {
            report($e);
            
            return Redirect::back()->with('error', 'Ocorreu um erro inesperado, tente novamente');
        }
                  

    }


     



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function show(Applicant $applicant)
       {
        try{

        if(!$applicant){
            return Redirect::to('/dashboard');
           }
    
           return view('Applicant.show',['applicant'=>$applicant]);
        
        }catch (Throwable $e) {
            report($e);
            
            return Redirect::back()->with('error', 'Ocorreu um erro inesperado, tente novamente');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function edit(Applicant $applicant)
    {
        try{

        if(!$applicant){
            return Redirect::to('/dashboard');
           }
    
           return view('Applicant.edit',['applicant'=>$applicant]);

        }catch (Throwable $e) {
            report($e);
            
            return Redirect::back()->with('error', 'Ocorreu um erro inesperado, tente novamente');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function update(ApplicantUpdateRequest $request, Applicant $applicant)
    {
        
        try{

        if(!$applicant){
            return Redirect::to('/dashboard');
           }

       $applicant->update([       
        'name'=>$request->name,
        'gender'=>$request->gender,
        'age'=>$request->age,
        'photo'=>null,
       ]);
     
      
     return view('Applicant.show',['applicant'=>$applicant]);

    }catch (Throwable $e) {
        report($e);
        
        return Redirect::back()->with('error', 'Ocorreu um erro inesperado, tente novamente');
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Applicant $applicant)
    {
        try {
        if(!$applicant){
            return  response()->json(['status'=>false,'message'=>'Ocorreu um erro ao deletar']);
          }
    
            $result = $applicant->delete();
    
            if(!$result){
              return  response()->json(['status'=>false,'message'=>'Ocorreu um erro ao deletar']);
            }
    
            return  response()->json(['status'=>true,'message'=>'Candidato deletado com sucesso']);

        }catch (Throwable $e) {
            report($e);
            
            return  response()->json(['status'=>false,'message'=>'Ocorreu um erro inesperado, tente novamente']);
        }
    
    }


   
    public function profile()
    {

        try {
        $applicantId = Auth::user()->userable_id;
        $applicant = Applicant::where('id','=',$applicantId)->first();
        

        if(!$applicant){
            return Redirect::to('/dashboard');
           }
    
           return view('Applicant.profile',['applicant'=>$applicant]);

        }catch (Throwable $e) {
            report($e);
            
            return Redirect::back()->with('error', 'Ocorreu um erro inesperado, tente novamente');
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function profileUpdate(ApplicantUpdateRequest $request )
    {

        try {

        $applicantId = Auth::user()->userable_id;
        $applicant = Applicant::where('id','=',$applicantId)->first();

        if ($request->hasFile('photo')) {            
        
        $this->savePhoto($request,$applicant);
     
        }
    

       $applicant->update([       
        'name'=>$request->name,
        'gender'=>$request->gender,
        'age'=>$request->age,
       ]);
     
 
     
     return view('Applicant.show',['applicant'=>$applicant]);
    
    }catch (Throwable $e) {
        report($e);
        
        return Redirect::back()->with('error', 'Ocorreu um erro inesperado, tente novamente');
    }

    }

   
   
   
    public function applications(){

        try {

        $applicantId = Auth::user()->userable_id;;

        $application = Applicant::where('id','=',$applicantId)->with(['vacancies'])->get();

        if(!$application){
            return Redirect::to('/dashboard');
           }

        return view('Applicant.my-job-applications',['application'=>$application]);

    }catch (Throwable $e) {
        report($e);
        
        return Redirect::back()->with('error', 'Ocorreu um erro inesperado, tente novamente');
    }

    }


    public function savePhoto(Request $request,Applicant $model=null){
               
                        
        $filename = time() . '.' . $request->file('photo')->extension();

        $photo = $request->photo->storeAs('avatar',  $filename , 'public');


        if(isset($model) && $model->photo != null){
            $checkPhoto = $this->deletePhoto($model->photo);
          
          }
        if(isset($model)){
            $model->photo = $photo;
            $model->save();
        } 
       
        return $photo;
            

        }


        public function deletePhoto($photo){

            if (Storage::disk('public')->exists($photo)) {
               
              $result =  Storage::disk('public')->delete($photo);
            
              return $result;      
    
            }       
    
          }

}
