function calculatebasicpay()
{
    rphbasic = document.getElementById("rateperhourbasic").value;
    ngbasic = document.getElementById("noofhoursbasic").value;
    document.getElementById("incompercutoff").value = rphbasic * ngbasic;
}
function calculatehonorpay()
{
    rphhonor = document.getElementById("rateperhourhonor").value;
    nghonor = document.getElementById("noofhourshonor").value;
    document.getElementById("totalhonorpay").value = rphhonor * nghonor;
}

