<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserAccountPlanInfo;
use App\Models\User;
use App\Models\EstimateSales;
use App\Models\Product;
use App\Models\RunCostEntry;
use App\Models\Stock;
use App\Models\sessions;
use App\Models\UniqueSingleEntry;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Message;
use Hash;
class UserActionsController extends Controller
{
    public function getUserPlan()
    {
       if (Auth::user()->userAccountInfo) {
           return[
        'current_date' => Auth::user()->userAccountInfo->current_date,
        'current_account_bal' => Auth::user()->userAccountInfo->current_account_bal,
        'currentAmazonSaldo' => Auth::user()->userAccountInfo->currentAmazonSaldo,
       ];
       }else{
        $date = Carbon::now();// will get you the current date, time
            return[
            'current_date' => $date->format('Y-m-d'),
            'current_account_bal' => 0,
            'currentAmazonSaldo' => 0,
           ];
       }
    }
    public function updateCurrentDate(Request $request)
    {
        $userData = $request->validate([
            'current_date' => 'nullable|date',
            'current_account_bal' => 'nullable|numeric',
            'currentAmazonSaldo' => 'nullable|numeric',
        ]);
        if (!empty($userData['current_date'])) {
            $savedvalue = ['current_date' =>  $userData['current_date']];
            $returnData = [
                'current_date' =>  $userData['current_date'],
                'updatetype' => 'current_date',
                'message' => 'Current Date Updated',
                'status'  => '200'
            ];
        }
        if (!empty($userData['current_account_bal'])) {
            $savedvalue = ['current_account_bal' =>  $userData['current_account_bal']];
            $returnData = [
                'current_account_bal' =>  $userData['current_account_bal'],
                'updatetype' => 'current_account_bal',
                'message' => 'Current Account Balance Updated',
                'status'  => '200'
            ];
        }
        if (!empty($userData['currentAmazonSaldo'])) {
            $savedvalue = ['currentAmazonSaldo' =>  $userData['currentAmazonSaldo']];
            $returnData = [
                'currentAmazonSaldo' => $userData['currentAmazonSaldo'],
                'updatetype' => 'currentAmazonSaldo',
                'message' => 'Current Amazon Saldo Updated',
                'status'  => '200'
            ];
        }
        $estimateSales = UserAccountPlanInfo::updateOrCreate(
            [
                'user_id' => Auth::user()->id
            ],
            $savedvalue
        );
        return $returnData;
    }
    public function userProfile(){
        return view('users.user_profile');
    }

    public function updateProfile(Request $request){

        $validator = \Validator::make($request->all(),[
            'name'=>'required',
            'email'=> 'required|email|unique:users,email,'.Auth::user()->id,

        ],[
            'name.reqired'=>'Enter current or new user name ',
            'email.required'=>'Enter current or new email ',
            'email.unique'=>'Email Address alredy taken '
        ]);

        if(!$validator->passes()){
            return response()->json(['status'=>0,'error'=>$validator->errors()->toArray()]);
        }else{
             $query = User::find(Auth::user()->id)->update([
                  'name'=>$request->name,
                  'email'=>$request->email,

             ]);
             return [

                'message' => 'Your password has been changed successfully',
            'status'  => '200',
            'result' => $query
                 ];
        }
    }
public function updatePhoto(Request $request){
    $path = '/media/gallary';
    $file= $request -> file('userProfileImg');
    $new_name= 'UIMG_'.date("Ymd").uniqid().'.jpg';
    $new_address=  $path."/".$new_name;
    $upload=$file ->move(public_path($path),$new_name);
    if(!$upload){
        return response()->json(['status'=>0,'msg'=>'Something went wrong, updating picture failed.']);
    }else{

       $update = User::find(Auth::user()->id)->update(['photo'=> $new_address]);
               if( !$upload ){
                   return response()->json(['status'=>0,'msg'=>'Something went wrong, updating picture in db failed.']);
               }else{
                   return response()->json(['status'=>1,'msg'=>'Your profile picture has been updated successfully']);
               }
    }
}
public function deleteAccount($id)
    {
        EstimateSales::where('user_id','=',$id)->delete();
        Product::where('user_id','=',$id)->delete();
        RunCostEntry::where('user_id','=',$id)->delete();
        sessions::where('user_id','=',$id)->delete();
        Stock::where('user_id','=',$id)->delete();
        UniqueSingleEntry::where('user_id','=',$id)->delete();
        User::where('id','=',$id)->delete();
        return[
            'message' => 'Account has been deleted successfully ',
            'status'  => '200'
        ];
    }
public function changePassword(Request $request){

        $validator = \Validator::make($request->all(),[
            'current_password'=>[
                'required', function($attribute, $value, $fail){
                    if( !\Hash::check($value, Auth::user()->password) ){
                        return $fail(__('The current password is incorrect'));
                    }
                },
                'max:30'
             ],
             'new_password'=>'required|min:8|max:30',
             'confirm_password'=>'required|same:new_password'
         ],[
             'current_password.required'=>'Enter your current password',
             'current_password.max'=>'Old password must not be greater than 30 characters',
             'new_password.required'=>'Enter new password',
             'new_password.min'=>'New password must have atleast 8 characters',
             'new_password.max'=>'New password must not be greater than 30 characters',
             'confirm_password.required'=>'ReEnter your new password',
             'confirm_password.same'=>'New password and Confirm new password must match'
         ]);

        if( !$validator->passes() ){
            return response()->json(['status'=>0,'error'=>$validator->errors()->toArray()]);
        }else{

         $update = User::find(Auth::user()->id)->update(['password'=>\Hash::make($request->new_password)]);
         return [

            'message' => 'Your password has been changed successfully',
        'status'  => '200',
        'result' => $update
             ];
         /* if( !$update ){
             return response()->json(['status'=>0,'msg'=>'Something went wrong, Failed to update password in db']);
         }else{
             return response()->json(['status'=>1,'msg'=>'Your password has been changed successfully']);
         } */
        }


}

/* public function changePassword(Request $request){
    if(!(Hash::check($request->get('current_password'),Auth::user()->password))){
        return back()->with('error','Current password is wrong');
    }
    if(strcmp($request->get('current_password'),$request->get('new_password'))==0){
        return back()->with('error','new password cant be same  as Current password');
    }
    $this->validate($request, [
        'current_password' => 'required',
        'new_password' => 'required|min:6',
        'confirm_password' => 'required|same:new_password'

    ]);
    $user=Auth::user();
    $user->password = bcrypt($request->get('new_password'));
    $user->save();
    return back()->with('message','password changed successfully');

}
 */
     /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    // public function update($user, array $input)
    // {
    //     Validator::make($input, [
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
    //         'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
    //     ])->validateWithBag('updateProfileInformation');

    //     if (isset($input['photo'])) {
    //         $user->updateProfilePhoto($input['photo']);
    //     }

    //     if ($input['email'] !== $user->email &&
    //         $user instanceof MustVerifyEmail) {
    //         $this->updateVerifiedUser($user, $input);
    //     } else {
    //         $user->forceFill([
    //             'name' => $input['name'],
    //             'email' => $input['email'],
    //         ])->save();
    //     }
    // }
}
