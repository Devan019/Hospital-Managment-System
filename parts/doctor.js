
Array.from(allup).forEach((e) => {
    e.addEventListener("click",(e) => {
       console.log(e.target.id);
  
       let tr = e.target.parentNode.parentNode;
       document.querySelector('#noof').value = e.target.id;
       document.querySelector("#name").value = tr.getElementsByTagName("td")[1].innerText;
       document.querySelector("#edu").value = tr.getElementsByTagName("td")[2].innerText;
       document.querySelector("#sp").value = tr.getElementsByTagName("td")[3].innerText;
       document.querySelector("#phone").value = tr.getElementsByTagName("td")[4].innerText;
       document.querySelector("#timing").value = tr.getElementsByTagName("td")[5].innerText;
    }
    )
  }
  )
  
  let alldel = document.querySelectorAll(".dels");
  
  Array.from(alldel).forEach((e) => {
    e.addEventListener("click",(e) => {
      document.querySelector("#id").value = e.target.id;
      console.log(e.target.id , "hm");
    }
    )
  }
  )
