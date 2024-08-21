let allinfo = document.querySelectorAll('.update');

Array.from(allinfo).forEach((e) => {
  e.addEventListener("click", (e) => {
     // Changed .infoform to #infoform
    
    
    let tr = e.target.parentNode.parentNode ;
  
    let name = tr.getElementsByTagName("td")[1].innerText;
    let age = tr.getElementsByTagName("td")[2].innerText;
    let phone = tr.getElementsByTagName("td")[3].innerText;
    let add = tr.getElementsByTagName("td")[4].innerText;
    let doctor = tr.getElementsByTagName("td")[5].innerText;
    let disease = tr.getElementsByTagName("td")[6].innerText;
    let med = tr.getElementsByTagName("td")[7].innerText;
    let room_no = tr.getElementsByTagName("td")[8].innerText;
    
    document.querySelector("#noof").value = e.target.id;
    document.querySelector("#name").value = name;
    document.querySelector("#age").value = age;
    document.querySelector("#phone").value = phone;
    document.querySelector("#address").value = add;
    document.querySelector("#doctor").value = doctor;
    document.querySelector("#disease").value = disease;
    document.querySelector("#medicines").value = med;
    document.querySelector("#room").value = room_no;
    
    console.log(document.querySelector("#noof").value);
    // let disease = tr.getElementsByTagName("td")[9].innerText;
    // let cont = tr.getElementsByTagName("td")[0].innerText;
    
    $('#infoModal').modal('toggle');
    
  });
});


let alldel = document.querySelectorAll('.DEL');

Array.from(alldel).forEach((e) => {
  e.addEventListener("click",(e) => {
    document.querySelector('.deleter').value = e.target.id;
    console.log(document.querySelector('.deleter').value , e.target.id , "op" ,e.target.parentNode.parentNode);
  }
  )
}
)