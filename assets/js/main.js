// main.js - helpers
document.addEventListener('DOMContentLoaded', function(){
  document.querySelectorAll('form[data-ajax="true"]').forEach(form=>{
    form.addEventListener('submit', async function(e){
      e.preventDefault();
      const fd = new FormData(this);
      const res = await fetch(this.action, { method: this.method || 'POST', body: fd });
      const text = await res.text();
      console.log(text);
      // you may reload or handle response
      location.reload();
    });
  });
});
