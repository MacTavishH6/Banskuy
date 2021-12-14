<script type="text/template" id="component-list-user">
    <button data-id="<%=data.id%>" id="<%=data.name%>" onclick="btnChooseUserOnClick(this)" class="list-group-item list-group-item-action py-3 lh-tight" aria-current="true">
        <div class="d-flex w-100 align-items-center justify-content-between">
          <input type="hidden" value="<%=data.role%>">
          <strong class="mb-1"><%=data.uname%></strong>
          <small><%=data.date%></small>
        </div>
        <div class="col-10 mb-1 small"><%=data.message%></div>
      </button>
</script>