$(function(){
  $('#cancelarPedidoUsuario').click(function(){
    $.ajax({
    type: 'POST',
    url:'my-orders.php',
    data:{finalizarpedido: $('finalizarpedido').val()},
    success: function (response) {
    confirm('Deseja realmente cancelar seu pedido?');
    alert('Pedido cancelado com com sucesso');
    location.reload();
    },
    error: function () {
    alert('Erro ao solicitar o cancelamento. Tente novamente!');
    }
  });
});
});


$(function(){
  $('#AtualizarPedidoADM').click(function(){
    var confirmed = confirm("Deseja realmente atualizar o Status deste pedido?");
    if (confirmed) {
      $.ajax({
      type: 'POST',
      url:'orders.php',
      data:{finalizaStatus: $('finalizaStatus').val()},
      success: function (response) {
      alert('Status atualizado com sucesso!'),
      location.reload();
      },
      error: function () {
      alert('Erro ao atualiza pedido. Tente novamente!');
      }
    });
  }
});
});


//function excluir() {
    //$.ajax({
        //url: "delete.php?id=<?=$usuario['id']?>",
        //type: "GET",
        //success: function(){
            //location.reload();
        //}
    //});
//}


  function Mudarestado(el) {
    var display = document.getElementById(el).style.display;
    if(display == "none")
        document.getElementById(el).style.display = 'block';
    else
        document.getElementById(el).style.display = 'none';
}


document.addEventListener("DOMContentLoaded", function(event) {

  const showNavbar = (toggleId, navId, bodyId, headerId) =>{
  const toggle = document.getElementById(toggleId),
  nav = document.getElementById(navId),
  bodypd = document.getElementById(bodyId),
  headerpd = document.getElementById(headerId)
  
  // Validate that all variables exist
  if(toggle && nav && bodypd && headerpd){
  toggle.addEventListener('click', ()=>{
  // show navbar
  nav.classList.toggle('show')
  // change icon
  toggle.classList.toggle('bx-x')
  // add padding to body
  bodypd.classList.toggle('body-pd')
  // add padding to header
  headerpd.classList.toggle('body-pd')
  })
  }
  }
  
  showNavbar('header-toggle','nav-bar','body-pd','header')
  
  /*===== LINK ACTIVE =====*/
  const linkColor = document.querySelectorAll('.nav_link')
  
  function colorLink(){
  if(linkColor){
  linkColor.forEach(l=> l.classList.remove('active'))
  this.classList.add('active')
  }
  }
  linkColor.forEach(l=> l.addEventListener('click', colorLink))
  
  // Your code to run since DOM is loaded and ready
  });



