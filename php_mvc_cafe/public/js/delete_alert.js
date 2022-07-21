function confirmDelete() {
  var ret=confirm("削除を実行しますか？");
  if(!ret) alert("削除をキャンセルしました");
  return ret;
}