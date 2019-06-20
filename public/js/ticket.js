let parking = document.querySelector('#haveParking').innerHTML;


function checkParkingState(){
    if(parking == 1){
        parking = '<i class="fas fa-check"></i>';
        
        
    } else{
        parking = '<i class="fas fa-times"></i>';
    }
    document.querySelector('#haveParking').innerHTML = parking;
}
checkParkingState();