console.log("test.js");

const btn = document.querySelector("#btnTheme");
const thme = document.querySelector("#theme");
const user_id = document.querySelector("#user_id");

btn.addEventListener("click",putTheme );


async function putTheme (e) {
    try{
        e.preventDefault();
        console.log("click");
        let formData = new FormData();
        formData.append("theme", thme.value);
        formData.append("user_id", user_id.value);

        const url = "http://localhost:8888/twitter/theme";

        const response = await fetch(url, {
            method: "POST",
            body: formData
        });

        const data = await response.json();

        console.log(data);

    }catch(error){
        console.log(error);
    }
    
}