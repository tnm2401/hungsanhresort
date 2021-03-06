<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\ShareController;
use Contactform;
use Validate;
use Mail;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;


class ContactformController extends ShareController
{
    public function index(){
        $contactforms = Contactform::orderBy('stt','asc')->orderBy('id','desc')->get();
        return view('backend.contactforms.index', compact('contactforms'));
    }

    public function edit(Request $request, $id)
    {
        $contactform = Contactform::find($id);
        return view('backend.contactforms.edit', compact('contactform'));
    }

    public function store(Request $request)
    {
        $lang = [
            'name.required' => trans('validation_lang.name'),
            'phone.required' => trans('validation_lang.phone'),
            'captcha.required' => trans('validation_lang.captcha'),
            'captcha.captcha' => trans('validation_lang.captcha.captcha')
        ];
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'captcha' => 'required|captcha',

        ], $lang);
        $data = [
            'type' => $request->type,
            'stt' => $request->true ?? true,
            'name' => $request->name,
            // 'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'subject' => $request->subject,
            'contactcontent' => $request->contactcontent,
            'read' => $request->read,
            'note' => $request->note
        ];
        $contactform = Contactform::create($data);
        $setting = Setting::get()->first();
        $web = $setting->website;
        $emailadmin = $setting->email;
        if(isset($request->email) && !empty($request->email)){
            Mail::send('frontend.email.contact',[
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email,
                'subject' => $request->subject,
                'contactcontent' => $request->contactcontent
            ], function($mail) use($request,$web,$emailadmin){
                $mail->to($emailadmin,$request->name);
                $mail->from($request->email);
                $mail->subject('Th?? li??n h??? t??? Website: '.$web);
            });
        }
        if ($contactform) {
            alert()->success('???? g???i th??','Ch??ng t??i s??? ph???n h???i l???i cho b???n ngay');
            return redirect()->route('frontend.home.index');
        }
            return redirect()->route('frontend.contact.index')->with('success','C?? l???i x???y ra !');
    }
    public function update(Request $request, $id)
    {
        $lang = [
            'name.required' => 'Vui l??ng nh???p T??n danh m???c !',
            'name.max'     => 'Vui l??ng nh???p t???i ??a :max k?? t??? !',
        ];
        $request->validate([
            'name'  => 'required|max:120',
        ], $lang);
        $contactform          = Contactform::find($id);
        $contactform->type    = $request->type;
        $contactform->stt     = $request->stt;
        $contactform->name    = $request->name;
        $contactform->address = $request->address;
        $contactform->phone   = $request->phone;
        $contactform->email   = $request->email;
        $contactform->subject = $request->subject;
        $contactform->contactcontent = $request->contactcontent;
        $contactform->note    = $request->note;
        $contactform->read    = $request->read;
        $contactform->save();
        return redirect()->route('backend.contactform.index')->with('success','C???p nh???t th??ng tin li??n h??? th??nh c??ng !');
    }

    public function destroy(Request $request, $id)
    {
        $contactform = Contactform::find($id);
        if ($contactform) {
            $contactform->delete();
            return redirect()->route('backend.contactform.index')->with('success','X??a th??ng tin li??n h??? th??nh c??ng !');
        }
            return redirect()->route('backend.contactform.index')->with('success','Th??ng tin li??n h??? kh??ng t???n t???i !');
    }
    public function deletemultiple(Request $request)
    {
        $ids = $request->ids;
        Contactform::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['status'=>true,'message'=>'Xo?? th??nh c??ng c??c m???c ???? ch???n !']);
    }
    public function refereshCapcha(){
        return captcha_img('flat');
    }
    public function Read(Request $request){
        $contactform = Contactform::find($request->contactform_id);
        $contactform->read = $request->read;
        $contactform->save();
        return response()->json(['success'=>'Contactform Read change successfully.']);
    }
    public function changeStt(Request $request){
        $contactform = Contactform::find($request->contactform_id);
        $contactform->stt = $request->stt;
        $contactform->save();
        return response()->json(['success'=>'Contactform STT change successfully.']);
    }


}
