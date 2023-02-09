



const body= document.querySelector("body")
      sidebar=body.querySelector(".sidebar"),
      toggle=body.querySelector(".toggle"),
      searchBtn=body.querySelector(".search-box"),
      modeSwtich=body.querySelector(".toggle-switch"),
      modeText=body.querySelector(".mode-text"),
      // cards=body.querySelector("card");
    

      toggle.addEventListener("click",() =>{
        sidebar.classList.toggle("close");
      });


      modeSwtich.addEventListener("click",() =>{
        body.classList.toggle("dark");
      

      if(body.classList.contains("dark")){
          modeText.innerText="light Mode"
      }
      else{
        modeText.innerText="Dark Mode"
      }
      });

/*drop down*/
document.getElementById('show-child').onclick=function(){
  var getchild=document.getElementById('child-content')
  var hide=document.getElementById('hide-child')
  var toshow=document.getElementById('show-child')
  if(getchild.style.display='none'){
    getchild.style.display='block'
    toshow.style.display='none'
    hide.style.display='block'
  }else{
    //do nothing
  }
}
document.getElementById('hide-child').onclick=function(){
  var getchild=document.getElementById('child-content')
  var show=document.getElementById('show-child')
  var tohide=document.getElementById('hide-child')
  if(getchild.style.display='block'){
    getchild.style.display='none'
    show.style.display='block'
    tohide.style.display='none'
  }else{
    //do nothing
  }
}
// ===finish dropdown====

  
  





document.getElementById('btn-org').onclick=function(){
  var dash=document.getElementById('carde')
  var organ=document.getElementById('org-panel')
  var department=document.getElementById('deppanel')
  
  if(dash.style.display='block'){
    dash.style.display='none'
    organ.style.display='block'
    department.style.display='none'
  }
  else{
    //do nothing
  }
}
document.getElementById('depid').onclick=function(){
  var dash=document.getElementById('carde')
  var department=document.getElementById('deppanel')
  var organ=document.getElementById('org-panel')
  if(department.style.display='none'){
    dash.style.display='none'
    department.style.display='block'
    organ.style.display='none'
  }
  else{
    //do nothing
  }
}
