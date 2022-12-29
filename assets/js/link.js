var code, getIt, errorMessage;

getIt = document.getElementById("get");
errorMessage = document.getElementById("P-For-Errors");

getIt.addEventListener("click", callLinks);

function callLinks (){
  code = document.getElementById("code").value;

  switch (code){
    case "1":
      window.location.href = "https://kurdapp.tk/app";
      break;










      case "":
        errorMessage.innerHTML = "ژمارەی پوستەکە داخل بکە";
        errorMessage.style = "text-align:center;font-size:25px;color: semibold;font-family: UniQAIDAR_KAMARAN;";
        break;
  
      default:
        errorMessage.innerHTML = "ئەم ژمارەیە تومار نەکراوە";
        errorMessage.style = "text-align:center;font-size:25px;color: semibold;font-family: UniQAIDAR_KAMARAN;";
        break;
  
    }
  }
