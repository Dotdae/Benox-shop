// Nombre.

let nombre = document.getElementById('nombreCompleto');

nombre.addEventListener('change', () =>{

    let regexName = /^([A-ZÁÉÍÓÚ]{1}[a-zñáéíóú]+[\s]*)+$/;
    let spanName = document.getElementById('name-error');


    if(regexName.test(nombre.value)){

        nombre.style.borderColor = "#A8C0FF";
        spanEdad.textContent = '';

    }
    else{


        spanName.textContent = "Se debe comenzar con mayúcula";
        nombre.style.borderColor = "red";

    }

});


// Edad.

let edad = document.getElementById('edad');

edad.addEventListener('change', () => {

    let spanEdad = document.getElementById('edad-error');

    if(parseInt(edad.value) >= 18 && parseInt(edad.value) <= 100){

        edad.style.borderColor = "#A8C0FF";
        spanEdad.textContent = '';

    }
    else{

        spanEdad.textContent = 'Ingresar edad entre 18 y 100 años';
        edad.style.borderColor = 'red';

    }

});


// Correo.

let correo = document.getElementById('correoElectronico');

correo.addEventListener('change', () =>{

    let spanEmail = document.getElementById('email-error');

    if(correo.value.includes('.com') && correo.value.includes('@')){

        correo.style.borderColor = "#A8C0FF";
        spanEmail.textContent = '';

    }
    else{

        spanEmail.textContent = 'Agregar @ o .com';
        correo.style.borderColor = 'red';

    }


});


// Username.

let username = document.getElementById('username');

username.addEventListener('change', () =>{

    let spanUsername = document.getElementById('username-error');

    if(!(username.value.length < 5)){

        if(!(username.value.includes(' '))){

            let arrayNumbers = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0'];

            for(let i = 0; i < arrayNumbers.length; i++){

                if(username.value.includes(arrayNumbers[i])){

                    username.style.borderColor = '#A8C0FF';
                    spanUsername.textContent = '';
                    break;

                }
                else{

                    spanUsername.textContent = 'Agregar un número al nombre de usuario';
                    username.style.borderColor = 'red';

                }

                


            }

        }
        else{

            username.style.borderColor = 'red';
            spanUsername.textContent = 'Los espacios no están permitidos';

        }

    }
    else{

        username.style.borderColor = 'red';
        spanUsername.textContent = 'Se deben tener más de 5 caracteres';

    }

});


// Password.

let password = document.getElementById('password');

password.addEventListener('change', () =>{

    let spanPassword = document.getElementById('password-error');

    if(!(password.value.length < 8)){

        let specialChar = '!#$%&@_.;, ';
        let arrayNumbers = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0'];

        specialChar = specialChar.split('');

        let special, number;

        for(let i = 0; i < specialChar.length; i++){

            if(password.value.includes(specialChar[i])){

                password.style.borderColor = '#A8C0ff';
                special = true;
                spanPassword.textContent = '';
                break;

            }
            else{

                password.style.borderColor = 'red';
                spanPassword.textContent = 'Se debe ingresar al menos un caracter especial';

            }

        }

        for(let i = 0; i < arrayNumbers.length; i++){

            if(password.value.includes(arrayNumbers[i])){

                password.style.borderColor = '#A8C0FF';
                spanPassword.textContent = '';
                number = true;
                break;

            }
            else{

                password.style.borderColor = 'red';
                spanPassword.textContent = 'Se debe ingresar al menos un número';

            }

        }

        if(special && number){

            let contraseñaCifrada = cifrarContraseña(password.value);

        }
        else if(!special){

            password.style.borderColor = 'red';
            spanPassword.textContent = 'Se debe ingresar al menos un caracter especial';

        }
        else if(!number){

            password.style.borderColor = 'red';
            spanPassword.textContent = 'Se deben tener al menos un número';

        }


    }
    else{

        password.style.borderColor = 'red';
        spanPassword.textContent = 'Se deben tener más de 8 caracteres';

    }


});


// Validar contraseña.

let confirmPassword = document.getElementById('confirmPassword');

confirmPassword.addEventListener('change', () => {

    let spanConfirm = document.getElementById('confirm-error');

    if(confirmPassword.value === password.value){

        confirmPassword.style.borderColor = '#A8C0FF';
        spanConfirm.textContent = '';

    }
    else{

        confirmPassword.style.borderColor = 'red';
        spanConfirm.textContent = 'Las contraseñas no coinciden';

    }

});


function cifrarContraseña(password){

    return btoa(password);

}

function decifrarContraseña(password){

    return atob(password);

}