<tr style="background-color:#00b0f0; opacity:.8;color:#000 !important;">
<td width="100%" class="no_border" colspan="2">
    <table width="100%"><tbody><tr>
        <td style="width:4%"></td>
        <td style="width:3%;position:relative;padding:4px;">
            <img src="{{url('assets/img/black_icons/bank_doc.svg')}}" class="licence-img" style="height:40px" alt="bank doc">
            <span class="unread-indicator d-none ki"></span>
        </td>
        <td style="width:40%">
            <span style="color:#000 !important" class="  titleh  small_font">Local Forms</span>
            
        </td>
        <td style="width:53%"></td>
    </tbody></table></tr>
  
    @foreach($localForms as $disdata)
    @if(($disdata['type'] == 'local' && ($disdata['form_tab_content'])
    && $disdata['is_uppliment']!=1) || ($disdata['is_uppliment']==1 && is_array($supplimentForm) &&
    in_array($disdata['form_tab_content'], $supplimentForm)))
    
  
        <?php $singleFormTitle = isset($disdata['form_tab_description']) && !empty($disdata['form_tab_description']) ? '' : 'singleFormTitle';?>
      
                <tr style="background-color:transparent; color:#000000" class=""> 
                <td width="100%" class="no_border" colspan="2"><table width="100%"><tbody><tr>
                   
                    <td style="width:4%">
                                                
                    </td>
                    <td style="width:3%;position:relative;padding:4px;">
                    
                                            <img src="http://127.0.0.1:8000/assets/img/black_icons/home_loan.svg" class="licence-img d-none" style="height:40px" alt="icon"><span class="unread-indicator d-none ki">
                                        </span></td>
                    <td style="width:40%">
                                            <span style="color:#000000" class="  titleh  small_font">{{$disdata['form_name']}}</span><br>
                                            <span><?php echo isset($disdata['form_tab_description']) && !empty($disdata['form_tab_description']) ? $disdata['form_tab_description'] : ''; ?></span>
                                            
                   
                            </td>
                  
                    
                <td style="width:45%">
                <a href="javascript:void(0)" onclick="openWindow('<?php echo route('attorney_offical_form', ['id' => $client_id]); ?>?download={{$disdata['form_tab_content']}}')" class=" text-danger" title=""> <i style="font-size:28px;vertical-align:middle;" class="fa fa-file-pdf" aria-hidden="true"></i></a>
                    
                </td>
                <td style="width:8%"></td>
                </tr>
                    </tbody></table></td></tr>

    @endif
    @endforeach