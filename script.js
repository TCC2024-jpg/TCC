
const olho = document.getElementById("olho"); 
const s = document.getElementById("s");
s1 = document.getElementById("s1");

olho.addEventListener("mouseover", mostrar); 
olho.addEventListener("mouseout", esconder);

function mostrar(){
    s.type = "text";
    olho.className = "fa fa-eye";
}

function esconder(){
 s.type = "password"; 
 olho.className = "fa fa-eye-slash";
}

function validarSenha(){
    if (s.value != s1.value){
        alert("As senhas não conferem");
        s.value="";
        s1.value="";
        s.focus();
    }

}
