<!DOCTYPE html>
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <style>body {
         margin: 0 !important; padding: 15px; background-color: #FFF;
         }
         #customers tr:hover {
         background-color: #ddd;
         }
         img {
         border: 0;
         }
         @media screen and (max-width: 400px) {
         .h1 {
         font-size: 22px;
         }
         .two-column .column {
         max-width: 100% !important;
         }
         .three-column .column {
         max-width: 100% !important;
         }
         .two-column img {
         width: 100% !important;
         }
         .three-column img {
         max-width: 60% !important;
         }
         }
         @media screen and (min-width: 401px) and (max-width: 400px) {
         .two-column .column {
         max-width: 50% !important;
         }
         .three-column .column {
         max-width: 33% !important;
         }
         }
         @media screen and (max-width:768px) {
         img.logo {
         float: none !important; margin-left: 0% !important; max-width: 200px !important;
         }
         #callout {
         float: none !important; margin: 0% 0% 0% 0; height: auto; text-align: center; overflow: hidden;
         }
         #callout img {
         max-width: 26px !important;
         }
         .two-column .section {
         width: 100% !important; max-width: 100% !important; display: inline-block; vertical-align: top;
         }
         .two-column img {
         width: 100% !important; height: auto !important;
         }
         img.img-responsive {
         width: 100% !important; height: auto !important; max-width: 100% !important;
         }
         .content {
         width: 100%; padding-top: 0px !important;
         }
         }
      </style>
   </head>
   <body style="margin: 0; padding: 15px;" bgcolor="#FFF">
      <div style="width: 100%; table-layout: fixed;">
         <div style="width: 100%; background-color: #eee; max-width: 670px; margin: 0 auto;">
            <table style="border-spacing: 0; font-family: sans-serif; color: #727f80; width: 100%; max-width: 670px; margin: 0 auto;" bgcolor="#FFF">
               <tr>
                  <td style="border-bottom-width: 3px; border-bottom-color: #313437; border-bottom-style: solid; padding: 0;" bgcolor="#C2C1C1">
                  </td>
               </tr>
            </table>

              @if(isset($compdata))
            <table style="border-spacing: 0; font-family: sans-serif; color: #727f80; width: 100%; max-width: 610px; border-radius: 6px; margin: 25px auto 0;" bgcolor="#FFF">
               <tr>
                  <td style="font-size: 0; padding: 5px 0 10px;" align="center">
                     <div style="width: 100%; max-width: 300px; display: inline-block; vertical-align: top;">
                        <table width="100%" style="border-spacing: 0; font-family: sans-serif; color: #727f80;">
                           <tr>
                              <td style="padding: 10px;">
                                 <table style="border-spacing: 0; font-family: sans-serif; color: #727f80; font-size: 16px; line-height: 20px; text-align: justify; width: 100%; padding-top: 20px;">
                                    <tr>
                                       <td align="center" style="padding: 0;">
                                          <a href="#d41d8cd98f00b204e9800998ecf8427e" style="color: #F1F1F1; text-decoration: none;"><img src="{{ url('uploads/'.$compdata->logo) }}" style="margin-left: 5%; max-width: 200px !important; width: 100%; height: auto; border: 0;" align="left"></a>
                                       </td>
                                    </tr>
                                 </table>
                              </td>
                           </tr>
                        </table>
                     </div>
                     <div style="width: 100%; max-width: 300px; display: inline-block; vertical-align: top;">
                        <table width="100%" style="border-spacing: 0; font-family: sans-serif; color: #727f80;">
                           <tr>
                              <td style="padding: 10px;">
                                 <table style="border-spacing: 0; font-family: sans-serif; color: #727f80; font-size: 16px; line-height: 20px; text-align: justify; width: 100%; padding-top: 20px;">
                                    <tr>
                                       <td style="padding: 0;">
                                          <div style="float: right; height: auto; overflow: hidden; margin: 4% 5% 2% 0;">
                                           <ul style="list-style-type: none; margin-top: 1%; padding: 0;">
                                                <li style="display: inline-block;">Toll-Free: {{ $compdata->toll_free_no }}</li>
                                                <li style="display: inline-block;">Phone: {{ $compdata->mobile }}</li>
                                                <li style="display: inline-block;">{{ $compdata->website }}</li>
                                             </ul>
                                          </div>
                                       </td>
                                    </tr>
                                 </table>
                              </td>
                           </tr>
                        </table>
                     </div>
                     <!--- End Second Column of Two Columns -->
                  </td>
               </tr>
               <!--- End Two Column Section -->
            </table>
            @endif
            <!--- End Main Table -->
            <table style="border-spacing: 0; font-family: sans-serif; color: #727f80; width: 100%; max-width: 670px; margin: 0 auto;" bgcolor="#FFF">
               <!--- End Banner -->
            </table>
            <!--- End Outer Table -->
            <table style="border-spacing: 0; font-family: sans-serif; color: #727f80; width: 100%; max-width: 610px; border-radius: 6px; margin: 0 auto;" bgcolor="#FFF">
               <tr>
                  <td style="padding: 0;">
                     <img src="https://westcoastmovers.ca/wp-content/uploads/2019/emailPictures/12/hero.jpg" style="width: 100%; max-width: 670px; height: auto; border: 0;">
                  </td>
               </tr>
               <tr>
                  <td style="padding: 0;">
                     <table width="100%" style="border-spacing: 0; font-family: sans-serif; color: #727f80;">
                        <tr>
                           <td style="font-size: 16px; line-height: 20px; padding: 10px;" align="justify">
                              <h1><font color="#A52A2A">Dear {{ $customerName }}
                                 </font>
                              </h1>
                              <p style="margin: 0;">Below is your quotation and full breakdown for your move, with an estimated weight according to your residence size.<br>
                                 Quote based on: {{ $estimatedWeight }} lbs
                              </p>
                              <table style='font-family: "Trebuchet MS", Arial, Helvetica, sans-serif; border-collapse: collapse; width: 100%; border-spacing: 0; color: #727f80;'>
                                 <tr>
                                    <th style="color: white; padding: 12px 8px; border: 1px solid #ddd;" align="left" bgcolor="ec6666">Charges Break Down</th>
                                    <th style="color: white; padding: 12px 8px; border: 1px solid #ddd;" align="left" bgcolor="ec6666">Details</th>
                                    <th style="color: white; padding: 12px 8px; border: 1px solid #ddd;" align="left" bgcolor="ec6666"> Cost Amount</th>
                                 </tr>
                                 <tr style="" bgcolor="#f2f2f2">
                                    <td style="padding: 8px; border: 1px solid #ddd;">First 500 lbs. (if less than 2000 lbs.)</td>
                                    <td style="padding: 8px; border: 1px solid #ddd;">$800.00</td>
                                    <td style="padding: 8px; border: 1px solid #ddd;">${{ $first500 }}</td>
                                 </tr>
                                 <tr>
                                    <td style="padding: 8px; border: 1px solid #ddd;">Estimated Weight Charges {{ $estimatedWeight }} lbs</td>
                                    <td style="padding: 8px; border: 1px solid #ddd;">${{ $costPerPound }} / Pound</td>
                                    <td style="padding: 8px; border: 1px solid #ddd;">${{ $estimatedWeightCharges }}</td>
                                 </tr>


                                 @foreach($extra_charges as $kkeyy => $vall)
                                    <tr style="" bgcolor="#f2f2f2">
                                       <td style="padding: 8px; border: 1px solid #ddd;">{{  $kkeyy }}</td>
									   @if(sizeof($vall) > 1)
                                       <td style="padding: 8px; border: 1px solid #ddd;">{{ $vall[1] }}</td>
									   @else
                                       <td style="padding: 8px; border: 1px solid #ddd;"></td>
									   @endif
                                       <td style="padding: 8px; border: 1px solid #ddd;">{{ $vall[0] }}</td>
                                    </tr>
                                 @endforeach
                                 <tr>
                                    <th style="color: white; padding: 12px 8px; border: 1px solid #ddd;" align="left" bgcolor="ec6666"></th>
                                    <th style="color: white; padding: 12px 8px; border: 1px solid #ddd;" align="left" bgcolor="ec6666">Total</th>
                                    <th style="color: white; padding: 12px 8px; border: 1px solid #ddd;" align="left" bgcolor="ec6666">
                                       ${{ $total }} 
                                    </th>
                                 </tr>
                              </table>
                              <span style="font-size: small;">*The quote above is an estimate and does not reflect the final invoice.<br>
                              *The final invoice will be based on the government certified scales which will have the accurate weight of your shipment.<br>
                              *Other factors impacting the cost of your move may include minimum weights & professional packing or relocating these items: <br>  appliances, pianos, motorcycles, motor vehicles, overweight items etc. <br></span>
                              <h2>The services that are included with your relocation are as follows:</h2>
                              <ul>
                                 <li>Complete door to door & room to room service</li>
                                 <li>Loading, transportation & offloading of belongings</li>
                                 <li>Dissemble of basic furniture</li>
                                 <li>Coded tags for each item & inventory list</li>
                                 <li>Duratoin of Storage</li>
                                 <li>Standard insurance for goods in transit</li>
                                 <li>Floor protection (runners)</li>
                                 <li>Cargo insurance coverage up to $250,000.00</li>
                                 <li>Insured movers up to $2 million</li>
                              </ul>
                              <div style="background-color: #ffff; padding: 2px 16px;">
                                 <p style="margin: 0;">Talk to our Relocation Consultant for your discount ( Early Reservations, Seniors, Veteran, Students)
                                 </p>
                                 <p style="color: red; margin: 0;">Must Have Valid Proof</p>
                                 <br><br>
                              </div>
         </div>
         <br>


          @if($compdata)
         <table style="border-spacing: 0; font-family: sans-serif; color: #727f80; width: 100%; max-width: 610px; border-radius: 6px; margin: 0 auto;">
            <tr>
               <td>
                  <p style="border-bottom-width: 3px; border-bottom-color: #313437; border-bottom-style: solid; margin: 0;" align="center">
                     <span style="font-weight: bold; font-size: 30px">{{ $employeeName }}</span> <br>
                     <a href="westcoastmovers.ca" target="_blank" style="color: #F1F1F1; text-decoration: none;">
                     <img src="{{ url('uploads/'.$compdata->logo) }}"  style="max-width: 135px; display: block; margin: 0 auto; padding: 4% 0 1%; border: 0;"> <br>
                     </a>
                    {{ $compdata->address }} <br>
                     Toll Free: {{ $compdata->toll_free_no }} <br>
                     Phone: {{ $compdata->mobile }} <br>
                     Email: {{ $compdata->email }}<br>
                     Website: {{ $compdata->website }}
                  </p>
               </td>
            </tr>
         </table>
         <table style="border-spacing: 0; font-family: sans-serif; color: #727f80; width: 100%; max-width: 610px; border-radius: 6px; margin: 0 auto;" bgcolor="#FFF">
            <tr>
               <td style="padding: 0;">
                  <table width="100%" style="border-spacing: 0; font-family: sans-serif; color: #727f80;">
                     <tr>
                        <td style="padding: 22px;">
                           <p style="font-size: 25px !important; font-weight: 600; line-height: 24px; color: #4A4A4A; margin: 12px 0 20px;" align="center">About {{ $compdata->name }}</p>
                           <p style="font-size: 16px; line-height: 24px; margin: 0;" align="justify">

                              {!! $compdata->company_info !!}

                           </p>

                           
                        </td>
                     </tr>
                  </table>
               </td>
            </tr>
            <!--- End Heading, Text & Button Section -->
         </table>
         @endif
        
         </td>
         </tr> <!--- End Heading, Text & Button Section -->
         </table> <!--- End Main Table -->
         <br>
         </td>
         </tr>
         </table>
      </div>
      </div>
   </body>
</html>