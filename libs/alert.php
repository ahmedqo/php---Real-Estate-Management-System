<?php
    session_start();
    if(!empty( $_SESSION['eror'] ))
    {
        echo '
            <div class="info" id="error" style="z-index:20;display:none">
                <div class="col-3">
                    <div class="col-1 contents container">
        ';
        if( $_SESSION['eror']['type'] == 'success')
        {
            echo '
                        <div class="col-1" style="display:flex;;justify-content:center">
                            <i class="fas fa-check-circle" style="font-size:140px;color:#11fa63;"></i>
                        </div>
            ';
        }
        if( $_SESSION['eror']['type'] == 'danger')
        {
            echo '
                        <div class="col-1" style="display:flex;justify-content:center">
                            <i class="fas fa-times-circle" style="font-size:140px;color:#fc0330;"></i>
                        </div>
            ';
        }
        echo '
                        <div class="col-1" style="text-align:center;font-size:25px">'.$_SESSION['eror']['msg'].'</div>
                        <div class="col-4" style="text-align:center">
                            <a class="button" style="background:#337ab7;width:100%;font-size:20px;font-size:25px;line-height:40px" id="ok">OK</a>
                        </div>
                    </div>
                </div>
            </div>
        ';
    }
    unset($_SESSION['eror']);
?>