
let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
scanner.addListener('scan', function (content) 
{
        //alert(content);
        var con=document.getElementById('scanned');
        con.value=content;
        
});
Instascan.Camera.getCameras().then(function (cameras) 
{
        if (cameras.length > 0) 
        {
          scanner.start(cameras[0]);
        } else 
        {
          console.error('No cameras found.');
        }
}).catch(function (e) {
        console.error(e);
      });