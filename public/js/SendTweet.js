let tweetbuttonn = document.getElementById('tweeteButton');
let ContainTweet = document.getElementById('pourTweet')

fetch("http://localhost/twitter/displayTweets", {
       method: "POST"
   })

       .then((response) => response.text())

       .then((text) => {
           //console.log(text);
        let Tweets = JSON.parse(text)
    
        Tweets.forEach(element => {
           let name = element['name']
           let username = element['username']
           let content = element['content']
           let majid = element['avatar']
           let media = element['media']
           let linkMedia = "http://localhost/twitter/public/assets/TweetImg/"
           if(majid === null){
            majid = "http://localhost/twitter/public/assets/Profile_IMG/avatar.png"
           }
           
           
            //console.log(majid)
          
        


            //je creer la div principale et ajouter la class tweetcom
            let newdiv = document.createElement("div");
            newdiv.classList.add("TweetCont");

        //      //creer une div qui pour l'image de profile
           let DivImg = document.createElement("div")
           DivImg.classList.add("IMGprofile")
           var img = document.createElement('img');
           img.src = majid
           //img.classList.add('imgsrc')
          DivImg.append(img)
          newdiv.appendChild(DivImg)
          ContainTweet.appendChild(newdiv)
            
            //creer une div qui regroupe un le nom et le user name
             let nameContain = document.createElement("div");
             nameContain.classList.add("NameUserContain");
              
             // creer une div pour le name
               let nameDiv = document.createElement("div");
               nameDiv.classList.add("Namecontain");
               let h4 = document.createElement('h3')
               h4.append(name)
               nameDiv.appendChild(h4)
               nameContain.appendChild(nameDiv)
               newdiv.appendChild(nameDiv)
               ContainTweet.appendChild(newdiv)

             // creer une une div pour username
             let usernameDiv = document.createElement("div");
             usernameDiv.classList.add("Usernamecontain");
             let Adiv = document.createElement('a')
             Adiv.append(username)
             usernameDiv.appendChild(Adiv)
             nameContain.appendChild(usernameDiv)
             newdiv.appendChild(usernameDiv)
             ContainTweet.appendChild(newdiv)


             //creer une div pour le contenue
             let Containtdivv = document.createElement("div");
             Containtdivv.classList.add("ContaintTweet");
             

             //creer un element P pour lez tweet
             let PTweets = document.createElement("p")
             PTweets.classList.add("Contenue");
            PTweets.append(content)
            Containtdivv.appendChild(PTweets)
            newdiv.appendChild(Containtdivv)
            ContainTweet.appendChild(newdiv)
             
            //pour les media
            let Containtmedia = document.createElement("div")
            Containtmedia.classList.add("Contenumedia")
            
            let imgmedia = document.createElement("img")
            
             if(media != null){
                 Containtmedia.appendChild(imgmedia)
                 newdiv.appendChild(Containtmedia)
                 ContainTweet.appendChild(newdiv)
               let yum =  media.slice(57)

               link = linkMedia.concat('', yum);
               imgmedia.src = link
             }
 

            
            
        });
       });



tweetbuttonn.onclick = function(){
    let tweetContain = document.getElementById('tweetContent').value;
let tweetImage = document.getElementById('getImage'); 
  //console.log(tweetbuttonn)
    console.log(tweetContain);
   let data = new FormData()
    data.append('image', tweetImage.files[0])
    data.append('tweet', tweetContain)
   fetch("http://localhost/twitter/SendTweet", {
       method: "POST",
       mode: 'no-cors',
       body: data
   })

       .then((response) => response.text())

       .then((text) => {
           //console.log(text);
       });
};




//   



// };
   


// async function putTheme (e) {
//   //console.log("hello");
//    try {
//        // e.preventDefault();
//         const url = "http://localhost/twitter/displayTweets";

//         const response = await fetch(url, {
//             method: "POST",
//         });

//         const data = await response.json();

//         //console.log(data);
//         //console.log(ContainTweet)
      
//        let tweetsIn= JSON.parse(data);
//        console.log(tweetsIn);
//         tweetsIn.forEach(item, index => {
//           console.log(index)
//       });

//     } catch (error) {
//         //console.log(error);
//     }

// }
// putTheme();