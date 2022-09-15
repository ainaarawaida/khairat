<script>

    document.addEventListener("DOMContentLoaded", function(){
            let ele = document.querySelector("#account_first_name") ;
            let ele2 = document.querySelector("label[for='account_first_name']") ; 
            let ele3 = document.querySelector("#account_last_name") ; 
            let ele4 = document.querySelector("#account_display_name") ; 
            
            ele.parentNode.classList.add("form-row-wide");
            ele.parentNode.classList.remove("form-row-first");
            ele3.parentNode.innerHTML =  "" ;
            ele4.parentNode.innerHTML =  "" ;
            ele2.innerHTML = "Nama" ;
            console.log(ele2);
           
        
    });
    
</script>
            