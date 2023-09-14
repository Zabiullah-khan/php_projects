window.addEventListener('load',()=>{

var opt = document.querySelector('#location');
var age = document.querySelector('#yob')
var anim = document.querySelector('#animlogo')


function fetch_hosur_data(){

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        obj = JSON.parse(this.response);

        for(i=0;i<obj["hosur"].length;i++){

                select_opt = document.createElement('option');
                select_opt.text = obj["hosur"][i]
                select_opt.style.fontFamily='fantasy';
                opt.appendChild(select_opt);

            }

            
        }
    };
    var obj = xhttp.open("GET", "css/hosurlist.json", true);
    xhttp.send();

}fetch_hosur_data()
})