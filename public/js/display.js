
// theme 
let theme = { color: "#1D9BF0", background: "rgb(0,0,0)", size: "2rem" };
const chooseColor = document.querySelectorAll(".chooseColor__item");

chooseColor.forEach(function (item) {
  item.style.backgroundColor = item.dataset.color;

  item.addEventListener("click", function () {
    chooseColor.forEach(function (itm) {
      itm.innerHTML = "";
    });
    item.innerHTML = '<ion-icon name="checkmark-outline"></ion-icon>';
    theme.color = item.dataset.color;
    setTheme("themeName", theme);
  });
});

const chooseBackground = document.querySelectorAll(".chooseBackground__item");

chooseBackground.forEach(function (item) {
  item.addEventListener("click", function () {
    chooseBackground.forEach(function (itm) {
      const el = itm.querySelector(".chooseBackground__radio");
      itm.classList.remove("bdr-primary");
      el.classList.remove("bg");
      el.innerHTML = "";
    });
    item.classList.add("bdr-primary");
    const element = item.querySelector(".chooseBackground__radio");
    element.classList.add("bg");
    element.innerHTML = '<ion-icon name="checkmark-outline"></ion-icon>';

    theme.background = item.dataset.background;

    setTheme("themeName", theme);
  });
});


const chooseSize = document.querySelector(".chooseSize__range__line");
chooseSize.addEventListener("click", getPosMouseLine)


 function getPosMouseLine(event) {
    let rect = event.target.getBoundingClientRect();
    let x = event.clientX - rect.left;
    x = x*100 / rect.width;
    x = Math.round(x);

   const circles =  document.querySelectorAll(".chooseSize__range__circle")

   circles.forEach(function(circle){
       circle.classList.remove("current");
   })


   let element;

    if(x <= 15){
        element = document.querySelector(".chooseSize__range__circle:nth-child(1)");
        element.classList.add("current");
        document.documentElement.style.setProperty("--display-line", "1%")
        theme.size = element.dataset.size;
    }
    else if(x > 15 && x <= 40){
        element = document.querySelector(".chooseSize__range__circle:nth-child(2)");
        element.classList.add("current");
        document.documentElement.style.setProperty("--display-line", "25%")
        theme.size = element.dataset.size;
    }
    else if(x > 45 && x <= 65){
        element = document.querySelector(".chooseSize__range__circle:nth-child(3)");
        element.classList.add("current");
        document.documentElement.style.setProperty("--display-line", "50%")
        theme.size = element.dataset.size;
    }
    else if(x > 65 && x <= 85){
        element = document.querySelector(".chooseSize__range__circle:nth-child(4)");
        element.classList.add("current");
        document.documentElement.style.setProperty("--display-line", "75%")
        theme.size = element.dataset.size;
    }
    else if(x > 85){
        element = document.querySelector(".chooseSize__range__circle:nth-child(5)");
        element.classList.add("current");
        document.documentElement.style.setProperty("--display-line", "100%")
        theme.size = element.dataset.size;
    }
    setTheme("themeName", theme);
   
}

function setTheme(themeName, dataTheme) {
  const background1 = "rgb(255,255,255)";
  const background2 = "rgb(0,0,0)";
  const background3 = "rgb(21, 32, 43)";
  const color1 = "#0F141A";
  const color2 = "#D9D9D9";
  const certificateBackground1 = "#1D9BF0";
  const certificateBackground2 = "#D9D9D9"
  const certificateBackground3 = "#fff";
  const brandBackground1 = "#F7F9F9";
  const brandBackground2 = "#15181C";
  const brandBackground3 = "#192734";

  localStorage.setItem(themeName, JSON.stringify(dataTheme));
  let getTheme = localStorage.getItem(themeName);
  getTheme = JSON.parse(getTheme);

  // console.log("theme",getTheme);

 switch (getTheme.background) {
   case background1:
    document.documentElement.style.setProperty(
      "--brandBackground",
      brandBackground1
    );
    document.documentElement.style.setProperty(
      "--certificateBackground",
      certificateBackground1
    );

     break;
    case background2:
      document.documentElement.style.setProperty(
        "--brandBackground",
        brandBackground2
      );
      document.documentElement.style.setProperty(
        "--certificateBackground",
        certificateBackground2
      );
      break;
    case background3:
      document.documentElement.style.setProperty(
        "--brandBackground",
        brandBackground3
      );
      document.documentElement.style.setProperty(
        "--certificateBackground",
        certificateBackground3
      );
   default:
     break;
 }

  if (getTheme.background === background1) {
    document.documentElement.style.setProperty("--secondary", color1);
  } else {
    document.documentElement.style.setProperty("--secondary", color2);
  }
  document.documentElement.style.setProperty(
    "--background",
    getTheme.background
  );
  document.documentElement.style.setProperty(
    "--primary",
    getTheme.color
  );
  document.documentElement.style.setProperty(
    "--text-size",
    getTheme.size
  );
}