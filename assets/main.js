

var login  = {
  utilisateur : 'admin' ,
  motdepasse : '0000' ,
  div : document.querySelector('.login'),
show : function(clearCookies) {
login.div.classList.add('show')
},
hide : function(){
  login.div.classList.remove('show');
},
init : function(){




}
}

// 
// function connexion(){
//   var utilisateur = document.getElementById('utilisateur').value ,
//   pass = document.getElementById('motdepass').value ;
//
//   if ( utilisateur == login.utilisateur && pass == login.motdepasse) {
// console.log('correct');
// login.hide();
// login.init();
//   } else {
//     console.log('incorrect');
//   }
//
// }
