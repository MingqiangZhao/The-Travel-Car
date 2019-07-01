<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function search_result_parking($result){
    //printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%d</td><td>%.00f</td></tr>", 
    //$result['label'], $result['adress'], $result['name'], $result['rest_places'],$result['price_park']);
    
    echo '
        
        <div class="col-sm-3">
            <div class="card"> 
                <img src="../image/parking_lot.jpg" style="width:100%">
                
                <div class="card-body">
                    <p class="card-text">
                    
                        <p style="color:black">'."Parking lot: ".$result['label'].'</p>
                        <p class="top_name">'."Airport: ".$result['name'].'</p>
                        <p style="color:red">'."Price: $".$result['price_park'].'/day</p>
                        <p style="color:green">'."Rest Places: ".$result['rest_places'].'</p>
                        <form role="form" method="post" action="router.php?action=confirm_order_park" >
                                <input type="hidden" name="parking" value="confirm_order">
                                <input type="hidden" name="parkId" value="'.$result['parkId'].'">
                                <p><button type="submit" style="margin-bottom:10px">Choose</button></p>
                        </form>
                        <p>
                    </p>
                </div>
            </div>
        </div>
        ';
    /*echo '
        <li>
                <img src="image/car.jpg" width="200px" height="200px"/>
                <p class="top_name">'.$result['name'].'</p>
                <p><span>$'.$result['price_park'].'/day</span><a>加入购物车</a></p>
        </li>';*/
    
}

function search_result_renting($result){
    echo '
        
        <div class="col-sm-3">
            <div class="card"> 
                <img src="../image/car_park.jpg" style="width:100%">
                
                <div class="card-body">
                    <p class="card-text">
                        <p>'."Name: ".$result['carName'].'</p>
                        <p class="top_name">'."Doors: ".$result['doors'].'</p>
                        <p class="top_name">'."Seats: ".$result['seats'].'</p>
                        <p style="color:green">'."Time: ".$result['free_time_begin']."--".$result['free_time_end'].'</p>
                            
                        <p style="color:black">'."Parking lot: ".$result['label'].'</p>
                        <p class="top_name">'."Airport: ".$result['name'].'</p>
                        <p class="top_name">'."Adress: ".$result['adress'].'</p>
                        <p style="color:red">'."Price: $".$result['cost_rent'].'/day</p>
                        
                        <form role="form" method="post" action="router.php?action=confirm_order_rent" >
                                <input type="hidden" name="parking" value="confirm_order">
                                <input type="hidden" name="car_parked_id" value="'.$result['car_parked_id'].'">
                                <p><button type="submit" style="margin-bottom:10px">Choose</button></p>
                        </form>
                        <p>
                    </p>
                </div>
            </div>
        </div>
        ';
}

