$(() => {
let passwordInput = $("#password");
let passwordStrenght = $("#passwordStrenght");

let minStrenght = 60;

passwordInput.on("input",function(){
 
    let percentWidth = calculatePasswordStrength(passwordInput.val()) * 0.9 / minStrenght * 100;
    if(percentWidth>100){
        percentWidth = 100;
    }
    passwordStrenght.width(percentWidth + "%");
    passwordStrenght.removeClass();
    if(percentWidth >= 80){
        passwordStrenght.addClass("high");
    }
    else if(percentWidth > 50 ){
        passwordStrenght.addClass("medium");
    }
    else {
        passwordStrenght.addClass("low");
    }
})



const calculatePasswordStrength = (password) => {
    let possibleChars = 1;
    
    if(/[0-9]/.test(password)){
        possibleChars += 10;
    }
    if(/[a-z]/.test(password)){
        possibleChars += 26;
    }
    if(/[A-Z]/.test(password)){
        possibleChars += 26;
    }
    return password.length * Math.log(possibleChars)/Math.log(2);
}

})