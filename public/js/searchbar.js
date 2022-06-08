const form = document.querySelector("#formSearch");
const Right = document.querySelector(".Right");
const cancelSearch = document.querySelector(".cancelSearch");
const searchInput = document.querySelector(".searchInputDiv #search");
const baseUrl = document.location.origin+'/twitter/';

cancelSearch.addEventListener("click", () => {
  searchInput.value = "";
  document.querySelector("#containerSearchResult").remove();
  // searchInput.focus();
  focusInput();
  cancelSearch.style.display = "none";
});

searchInput.addEventListener("keyup", searchUser);
form.addEventListener("focusin",focusInput);
form.addEventListener("focusout", (event) => {
  if (document.querySelector("#containerSearchResult")) {
   document.body.addEventListener("click", hideDiv);
 }
 });

function searchUser(e) {
  if (e.target.value.length > 0) {
     
    cancelSearch.style.display = "block";
    getSearchUser()
    form.addEventListener("submit", (e) => {
      e.preventDefault();
      e.target.action = `${baseUrl}search?q=${searchInput.value}`;
      e.target.submit();
    });
  } else {
    cancelSearch.style.display = "none";
  }
}

function focusInput(){
  let divExit = document.querySelector("#containerSearchResult");
  if (divExit == null) {
  let div = document.createElement("div");
  div.classList.add("containerSearchResult");
  div.id = "containerSearchResult";
  div.innerHTML = `Try searching for people, topics, or keywords`;
  Right.appendChild(div);
  }
  console.log("ouii");
 if(divExit){
   divExit.style.visibility = "visible" ;
 }

}

function hideDiv() {
  document.querySelector("#containerSearchResult").style.visibility = "hidden";
  document.body.removeEventListener("click", hideDiv);
}

async function getSearchUser() {
    try{
        const containerSearchResult = document.querySelector(
            "#containerSearchResult"
          );

         if(containerSearchResult){
          containerSearchResult.innerHTML = `<div class="view_port">
          <div class="polling_message">
            En attente
          </div>
          <div class="cylon_eye"></div>
        </div>
        `;}
        let response = await fetch(`${baseUrl}datasearch?q=${searchInput.value}`)
        const data = await response.json();

        console.log(data);

      if (data.success) {
        containerSearchResult.innerHTML = "";
        containerSearchResult.style.justifyContent = 'space-between';
        containerSearchResult.style.alignItems = "flex-start";

        if (Object.keys(data.hashtags).length > 0 || Object.keys(data.users).length > 0) {
        
        if (Object.keys(data.hashtags).length > 0) {
            for (const hashtag of data.hashtags) {
                const div = document.createElement("div");
                div.classList.add("searchResult");
                const icon = document.createElement("div");
                icon.classList.add("searchResult__icon");
                icon.innerHTML = '<ion-icon name="search-outline"></ion-icon>';
               
                const tag = document.createElement("div");
                tag.classList.add("searchResult__hashtag");
                const h3 = document.createElement("h3");
                h3.classList.add("searchResult__tag");
                h3.textContent = hashtag.hashtag;

                tag.appendChild(h3);
                div.appendChild(icon);
                div.appendChild(tag);
                containerSearchResult.appendChild(div);
            }
        }
        if (Object.keys(data.users).length > 0) {
          for (const user of data.users) {
            let div = document.createElement("div");
            div.classList.add("searchResult");

            const avatar = document.createElement("div");
            avatar.classList.add("searchResult__avatar");
            const img = document.createElement("img");
            img.src = user.avatar
              ? user.avatar
              : "./public/assets/img/avatar.png";
            avatar.appendChild(img);

            const content = document.createElement("div");
            content.classList.add("searchResult__content");
            const h3 = document.createElement("h3");
            h3.classList.add("searchResult__name");
            h3.textContent = user.name;
            content.appendChild(h3);
            const h4 = document.createElement("h4");
            h4.classList.add("searchResult__username");
            h4.textContent = user.username;
            content.appendChild(h4);
            const p = document.createElement("p");
            p.classList.add("searchResult__description");
            p.textContent = user.location ?? "location";
            content.appendChild(p);

            div.appendChild(avatar);
            div.appendChild(content);
            containerSearchResult.appendChild(div);
          }
        }
    }
        else{
          containerSearchResult.style.justifyContent = 'center';
          containerSearchResult.style.alignItems = "center";
          containerSearchResult.textContent = "please try again";
        }
      }

      document.querySelectorAll(".searchResult").forEach((element) => {
        element.addEventListener("click", () => {
         
          let tag = element.querySelector(".searchResult__tag");
         let username = element.querySelector(".searchResult__username");
         let url = `${baseUrl}`;
         if(tag){
          // console.log("tag", encodeURI(`${baseUrl}search?q=${tag.textContent}`));
           url +=`search?q=${encodeURIComponent(tag.textContent)}`;
          }
          else{
            url +=`${encodeURIComponent(username.textContent.substring(1))}`;
          }
          window.location.href = url;
        });
      })
    }
    catch(error){
        console.log(error);
    }
}

