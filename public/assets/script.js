function calculateBMI(){
    let height = parseInt(document.getElementById('height').value);
    let weight = parseInt(document.getElementById('weight').value);
    let bmi = document.getElementById('bmi_display');
    let p = document.getElementById('bmi_body');
    let bmiVal = document.getElementById('bmi');
    if (height === "" || isNaN(height)) {
        // result.innerHTML = "Provide a valid Height!";
        return false;
    } else if (weight === "" || isNaN(weight)) {
        return false;
    // If both input is valid, calculate the bmi
    } else {
        let userBMI = (weight / Math.pow( (height/100), 2 )).toFixed(1)
        // Dividing as per the bmi conditions
        if (userBMI < 18.6) {
            bmi.value = userBMI;
            bmiVal.value = userBMI;
            p.innerHTML = `Under Weight 😒`;
            p.style.color = "#ffc44d"
        } else if (userBMI >= 18.6 && userBMI < 24.9) {
            bmi.value = userBMI;
            bmiVal.value = userBMI;
            p.innerHTML = `Normal Weight 😍`
            p.style.color = "#0be881"
        } else {
            bmi.value = userBMI;
            bmiVal.value = userBMI;
            p.innerHTML = `Over Weight 😮`
            p.style.color = "#ff884d"
        }
    }
}