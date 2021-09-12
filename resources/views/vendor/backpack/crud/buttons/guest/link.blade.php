<button class="btn btn-sm btn-link" onclick="copyLink()">Copiar link</button>
<script> 
function copyLink() {
  var copyText = "{{$entry->url}}";
  console.log(copyText);
  navigator.clipboard.writeText(copyText);
}
</script>