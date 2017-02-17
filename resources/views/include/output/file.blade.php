<object
  type="{{ $exporter->file->mime }}"
  data="{{route('getFileOneBytes',[$exporter->file->identifier ])}}"
  height="{{ $exporter->height }}"
  width="{{ $exporter->width }}">
  <h:outputText value="CLICK HERE : " />
  <h:outputLink value="{{route('getFileOneBytes',[$exporter->file->identifier ])}}" ><h:outputText value="DOWNLOAD" /></h:outputLink>
</object>
