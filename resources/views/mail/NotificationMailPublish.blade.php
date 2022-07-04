<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{{config('app.name')}}</title>
   <head>
      <style>
         .banner-color {
           background-color: #0f0f0f;
         }
         .title-color {
         color: #0f0f0f;
         }
       
         @media screen and (min-width: 500px) {
         .banner-color {
         background-color: #0f0f0f;
         }
         .title-color {
         color: #0f0f0f;
         }        
         }
      </style>
   </head>
   <body>
      <div style="background-color:#b3b3b3;padding:0;margin:0 auto;font-weight:200;width:100%!important">
         <table align="center" border="0" cellspacing="0" cellpadding="0" style="table-layout:fixed;font-weight:200;font-family:Helvetica,Arial,sans-serif" width="100%">
            <tbody>
               <tr>
                  <td align="center">
                     <center style="width:100%">
                        <table bgcolor="#FFFFFF" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto;max-width:1024px;font-weight:200;width:inherit;font-family:Helvetica,Arial,sans-serif" width="512">
                           <tbody>
                              <tr>
                                 <td bgcolor="#ffce8fcc" width="100%" style="background-color:#0f0f0f;padding:12px;border-bottom:2px solid #0f0f0f;">
                                    <table border="0" cellspacing="0" cellpadding="0" style="font-weight:200;width:100%!important;font-family:Helvetica,Arial,sans-serif;min-width:100%!important" width="100%">
                                       <tbody>
                                          <tr>
                                             <td align="left" valign="middle" width="50%"><span style="margin:0;color:#f1f1f1;font-weight:bold; white-space:normal;display:inline-block;text-decoration:none; font-size:30px;line-height:20px">{{config('app.name')}}</span></td>
                                             <td valign="middle" width="50%" align="right" style="padding:0 0 0 10px"><span style="margin:0;color:#f1f1f1;white-space:normal;display:inline-block;text-decoration:none;font-size:12px;line-height:20px">{{date('H:i:s')}}</span>
                                                <span style="margin:0;color:#f1f1f1;white-space:normal;display:inline-block;text-decoration:none;font-size:14px;line-height:20px">{{date('d.m.Y ')}}</span></td>
                                             <td width="1">&nbsp;</td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </td>
                              </tr>
                              <tr>
                                 <td align="left" width="100%">
                                    <table border="0" cellspacing="0" cellpadding="0" style="font-weight:200;font-family:Helvetica,Arial,sans-serif" width="100%">
                                       <tbody>
                                          <tr>
                                             <td width="100%">
                                                <table border="0" cellspacing="0" cellpadding="0" style="font-weight:200;font-family:Helvetica,Arial,sans-serif" width="100%">
                                                   <tbody>
                                                      <tr>
                                                         <td align="center" bgcolor="#8BC34A" style="border-bottom:1px solid #0d0a078c; padding:20px 48px;color:#0d0a07c2;" class="banner-color">
                                                            <table border="0" cellspacing="0" cellpadding="0" style="font-weight:200;font-family:Helvetica,Arial,sans-serif" width="100%">
                                                               <tbody>
                                                                  <tr>
                                                                     <td align="center" width="100%">
                                                                        <h1 style="padding:0;margin:0;color:#0d0a07c2;font-weight:500;font-size:16px;line-height:24px"></h1>
                                                                        <h1 style="padding:0;margin:0;color:#0d0a07c2;font-weight:500;font-size:14px;line-height:24px"></h1>
                                                                     </td>
                                                                  </tr>
                                                               </tbody>
                                                            </table>
                                                         </td>
                                                      </tr>
                                                         <tr>
                                                            <td align="center" style="padding:20px 0 10px 0">
                                                               <table border="0" cellspacing="0" cellpadding="0" style="font-weight:400;font-family:Helvetica,Arial,sans-serif" width="100%">
                                                                  <tbody>
                                                                     <tr>
                                                                        <td align="center" width="100%" style="padding: 0 15px;text-align: justify;color: #666666;font-size: 18px;line-height: 18px;">
                                                                           
                                                                           <h3 style="color: #666666; font-weight: 600; padding: 20px; margin: 0px; font-size: 48px; line-height: 30px; text-align: center;" class="title-color">Hi {{$data['name']}}!!!</h3>
                                                                           <p style="margin: 20px 0 5px 0;font-size: 15px; text-align:center; padding: 20px;"><b>{{$data['title']}}</b></p>
                                                                           <p style="margin:0px; font-size: 16px;text-align: center;">Public:</p>
                                                                           <p style="margin: 2px 0 2px 0;font-size: 20px;text-align: center;">{{$data['public']}}</p>                                                                             
                                                                           <p style="text-align:center; padding: 20px;"><a class="link-color" style="text-decoration:none; " href="{{ env('APP_URL') }}{{$data['link']}}">Link</a></p>                                                           
                                                                                                             
                                                                        </td>
                                                                     </tr>
                                                                  </tbody>
                                                               </table>
                                                            </td>                                                         
                                                         </tr>                                                                                                      
                                                   </tbody>
                                                </table>
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </td>
                              </tr>
                              <tr>
                                 <td align="left" width="100%" style="text-align:center;">
                                    <table bgcolor="#FFFFFF" border="0" cellspacing="0" cellpadding="0" style="padding:0 24px;color:#999999;font-weight:200;font-family:Helvetica,Arial,sans-serif text-align:center;" width="100%">
                                       <tbody>
                                          <tr style="text-align:center;">
                                             <td align="center" width="100%">
                                                <table border="0" cellspacing="0" cellpadding="0" style="text-align:center; font-weight:200;font-family:Helvetica,Arial,sans-serif" width="100%">
                                                   <tbody>
                                                      <tr style="text-align:center">
                                                         <td align="center" valign="middle" width="100%" style="border-top:1px solid #d9d9d9;padding:12px 0px 12px 0px; text-align:center; color:#4c4c4c;font-weight:200;font-size:12px;line-height:18px">
                                                             <h1 style="padding:0px;margin:0;color:#0d0a07c2;font-weight:bold;font-size:12px;line-height:20px text-align:center;"></h1>
                                                               <a class="link-color" style="text-decoration:none; text-align:center " href="mailto:szmo@99gmail.com">Mail design and features created Powered&nbsp;by&nbsp;Szmo</a>  
                                                             <h1 style="text-align:center; padding:0px 30px;margin:0;color:#0d0a07c2;font-weight:500;font-size:10px;line-height:20px">© {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')</h1>                                                       
                                                        
                                                         </td>
                                                      </tr>
                                                   </tbody>
                                                </table>
                                             </td>
                                          </tr>                                        
                                       </tbody>
                                    </table>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </center>
                  </td>
               </tr>
            </tbody>
         </table>
      </div>
   </body>
</html>