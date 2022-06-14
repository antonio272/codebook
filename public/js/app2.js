
window.onload = function(){
    var showf = document.getElementById("btnButton");
    showf.addEventListener("click", criaNovoPost);
    function criaNovoPost() {   
        let showd = document.getElementById("show");
        if (showd.style.display === "none") {
          //alert('I am clicked xz!'); 
                showd.style.display = "flex";
            }
        else {
            showd.style.display = "none";
        };
    }
    /**/
    

} 
    var showc = document.getElementById("showcomm");
    showc.addEventListener("click", showCommform);
    function showCommform() {   
        let showcc = document.getElementById("comm");
        if (showcc.style.display === "none") {
          //alert('I am clicked xz!'); 
                showcc.style.display = "block";
            }
        else {
            showcc.style.display = "none";
        };
    }/**/

    
    function showReplyForm(commentarioId,user) {
        
        var x = document.getElementById(`reply-form-${commentarioId}`);
        var input = document.getElementById(`reply-form-${commentarioId}-text`);
        
        if (x.style.display === "none") {
          x.style.display = "block";
          input.innerText=`@${user} `;
        } else {
          x.style.display = "none";
        }
    }
    /**/

    
    

    
  