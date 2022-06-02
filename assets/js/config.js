window.addEventListener('load', () => {

    let cookies = document.cookie;
    cookies = cookies.split(";");

    // Text tags.

    let arrayTags = ['h1', 'h2', 'h3', 'h4', 'span', 'p', 'label', 'a', 'th', 'td', 'li'];
    let elementsArray = [];

    for(let i = 0; i < arrayTags.length; i++){

        let tag = document.getElementsByTagName(arrayTags[i]);
        elementsArray.push(tag);

    }

    for(let i in cookies){

        if(cookies[i].search("tamañoFuente") > -1){

            let index = cookies[i].indexOf("=");
            let size = cookies[i].substring(index + 1);

            if(size == "chica"){

                fontSize("chica", elementsArray);

            }
            else if(size == "mediana"){

                fontSize("mediana", elementsArray);


            }
            else if(size == "grande"){

                fontSize("grande", elementsArray);


            }

        }
        else if(cookies[i].search("colorFondo") > -1){

            let index = cookies[i].indexOf("=");
            let color = cookies[i].substring(index + 1);

            document.body.style.background = color;

        }
        else if(cookies[i].search("colorLetra") > -1){

            let index = cookies[i].indexOf("=");
            let color = cookies[i].substring(index + 1);
            fontColor(elementsArray, color);

        }
        else if(cookies[i].search("colorHeader") > -1){

            let index = cookies[i].indexOf("=");
            let color = cookies[i].substring(index + 1);

            let header = document.getElementById('header');
            header.style.backgroundColor = color;

        }
        else if(cookies[i].search("colorFooter") > -1){

            let index = cookies[i].indexOf("=");
            let color = cookies[i].substring(index + 1);

            let footer = document.getElementById('footer');
            footer.style.backgroundColor = color;

        }

    }
    

});


function setConfig(){

    setFont();
    setBackgroundColor();
    setFontColor();
    setHeaderColor();
    setFooterColor();


}


function setFont(){

    let font = document.getElementById('fuente');

    document.cookie = "tamañoFuente=" + font.value + "; max-age=3600; path=/";


}

function setBackgroundColor(){

    let background = document.getElementById('color_fondo');
    
    document.cookie = "colorFondo=" + background.value + "; max-age=3600; path=/";

}

function setFontColor(){

    let fontColor = document.getElementById('color_letra');
    document.cookie = "colorLetra=" + fontColor.value + "; max-age=3600; path=/";

}

function setHeaderColor(){

    let headerColor = document.getElementById('color_header');
    document.cookie = "colorHeader=" + headerColor.value + "; max-age=3600; path=/";

}


function setFooterColor(){

    let footerColor = document.getElementById('color_footer');
    document.cookie = "colorFooter=" + footerColor.value + "; max-age=3600; path=/";


}

function cleanCookies(){

    document.cookie = "tamañoFuente=; max-age=0; path=/";
    document.cookie = "colorFondo=; max-age=0; path=/";
    document.cookie = "colorLetra=; max-age=0; path=/";
    document.cookie = "colorHeader=; max-age=0; path=/";
    document.cookie = "colorFooter=; max-age=0; path=/";

}

// Apply size


function fontSize(size, element){


    for(i = 0; i < element.length; i++){

        if(element[i].length != 0){
            
            if(size == "chica"){

                for(let j = 0; j < element[i].length; j++){

                    element[i][j].style.fontSize = "10px";
    
                }

            }
            else if(size == "mediana"){

                for(let j = 0; j < element[i].length; j++){

                    element[i][j].style.fontSize = "16px";
    
                }

            }
            else if(size == "grande"){

                for(let j = 0; j < element[i].length; j++){

                    element[i][j].style.fontSize = "22px";
    
                }

            }

            
        }         

    }

}

function fontColor(element, color){


    for(i = 0; i < element.length; i++){

        if(element[i].length != 0){

                for(let j = 0; j < element[i].length; j++){

                    element[i][j].style.color = color;
    
                }
            
        }         

    }

}

