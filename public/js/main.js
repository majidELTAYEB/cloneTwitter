// theme charge
(function () {
  const background1 = "rgb(255,255,255)";
  const background2 = "rgb(0,0,0)";
  const background3 = "rgb(21, 32, 43)";
  const color1 = "#0F141A";
  const color2 = "#D9D9D9";
  const certificateBackground1 = "#1D9BF0";
  const certificateBackground2 = "#D9D9D9";
  const certificateBackground3 = "#fff";
  const brandBackground1 = "#F7F9F9";
  const brandBackground2 = "#15181C";
  const brandBackground3 = "#192734";

    const userPrefersDarkMode = window.matchMedia(
      "(prefers-color-scheme: dark)"
    ).matches;
    
    const preferredTheme = userPrefersDarkMode ? "dark" : "light";
  
    // console.log(preferredTheme);
  
    if (preferredTheme === "light") {
      console.log(userPrefersDarkMode);
      document.documentElement.style.setProperty("--background", background1);
      document.documentElement.style.setProperty("--secondary", color1);
    } else {
      document.documentElement.style.setProperty("--background", background2);
      document.documentElement.style.setProperty("--secondary", color2);
    }
  
    const themeName = "themeName";
    let getTheme = localStorage.getItem(themeName);
    getTheme = JSON.parse(getTheme);
    // console.log(getTheme);
    if (getTheme) { 
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

  if(getTheme !== null){
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
  }

  })();

  const arrowBack = document.querySelector("#arrowBack");
  if(arrowBack){
  arrowBack.addEventListener("click", function (e) {
    e.preventDefault();
    console.log("click");
    window.history.back();
  });
  }