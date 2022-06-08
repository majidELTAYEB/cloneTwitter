let input = document.getElementById("input_Name");
let input_mail = document.getElementById("input_Mail");
let counter = document.getElementById("span");
console.log(counter);
let maxLength = input.getAttribute("maxlength");
const form = document.getElementById("form");
let day = 0;
let month = 0;
let year = 0;

input.addEventListener("keyup", (event) => {
  let valueLength = event.target.value.length;
  let leftCharLength = maxLength - valueLength;
  if (leftCharLength < 0) return;
  counter.innerText = leftCharLength;
});

$("#jour").change(function () {
  let Selectday = document.querySelector("#jour");
  day = Selectday.value;
  day = parseInt(day);
  console.log(typeof day);
});

$("#mois").change(function () {
  let Selectmonth = document.querySelector("#mois");
  month = Selectmonth.value;
  month = parseInt(day);
  console.log(typeof month);
});

$("#annee").change(function () {
  let Selectyear = document.querySelector("#annee");
  year = Selectyear.value;
  year = parseInt(year);
  console.log(typeof year);
});

$("#form").submit(function (e) {
  e.preventDefault();
  function getAge(date) {
    let diff = Date.now() - date.getTime();
    let age = new Date(diff);

    return Math.abs(age.getUTCFullYear() - 1970);
}
  let AgeCurrent = getAge(new Date(year, day, month)); //Date(année, mois, jour)
  if (AgeCurrent >= 18) {
    form.submit();
} else {
    alert("Tes trop petit mon gars");
}
});

// /var/www/html/twitter/app/Controllers/UserController.php
// const CONTROL = document.location.origin + "/app/Controllers/" ;
// console.log(CONTROL);

// $('#form').submit(function(){
  

// fetch(CONTROL + "UserController.php", {
// method: "POST"
// })
// .then((response)=> {return response.text()})
// .then((text)=>{
//   console.log(text);
// })
// })

//   $("#form").submit(function (e) {
//   let datas = $('form').serialize();
//   let type = "POST";
//   $.ajax({
//   type: type,
//   data: datas,
//   datatype: 'json',
//   done: function(data){
//   console.log(data);
//   },
//   fail: function(error){
//   console.log(error);
//   },
//   });
//   e.preventDefault();
// });

// $('#form').submit(function(){

// let age = 18;
// let setDate = new Date(year + age, month - 1, day);
// console.log(setDate);
// let currdate = new Date();
// console.log(typeof(currdate));

// if (currdate >= setDate) {

//   alert("+18");
// } else {
//   alert("- 18");
// }

// })

// if(input.value == '' && input_mail.value == ''){
//   $('#Validate').prop('disabled',true);
// }

//   if(error.nom == true && error.number == true){
//   $("#Validate").prop('disabled',false);
//   console.log('marche');
//   } else {
//   $('#Validate').prop('disabled',true);
//   console.log('marche pas');
//   }
// });

// input_mail.addEventListener('keyup',phonenumber);
// function phonenumber()
// {
//     const Regex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g;
//     const inputText = document.getElementById("input_Mail").value;
//     if(!inputText.match(Regex) ) {
//       $(input_mail).css("border","red solid 1px");
//       $("#Valid_Email").html("<p id='error_Email' style='color: red'>Entrez un mail valide</p>")
//       if(input == ''){
//         $('#Validate').prop('disabled',true);
//       }
//     } else {
//       $('#error_Email').remove();
//       $(input_mail).css("border","black solid 1px");
//       error.number = true;
//     }

// if(error.nom == true && error.number == true){
//   $("#Validate").prop('disabled',false);
//  console.log('marche');
// } else {
//   $('#Validate').prop('disabled',true);
//   console.log('marche pas');
// }
// }

// console.log(error);

/////////////////////////  VALIDATION FORMULAIRE  /////////////////////////////
