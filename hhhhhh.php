<div class="row">
  <div class="column">
    <img src="download.jfif" alt="Snow" style="width:100%">
  </div>
  <div class="column">
    <img src="download.jfif" alt="Forest" style="width:100%">
  </div>
  <div class="column">
    <img src="download.jfif" alt="Mountains" style="width:100%">
  </div>
</div>
<style>
/* Three image containers (use 25% for four, and 50% for two, etc) */
.column {
  float: left;
  width: 33.33%;
  padding: 5px;
}

/* Clear floats after image containers */
.row::after {
  content: "";
  clear: both;
  display: table;
}
.row {
  display: flex;
}

.column {
  flex: 33.33%;
  padding: 5px;
}
</style>