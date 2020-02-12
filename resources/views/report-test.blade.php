@extends('layouts.app')

@section('content')
<div id="app">
  <button onclick="send()">Send</button>
</div>
@endsection

@section('scripts')
<script>
  function send() {
    const x = axios.create({
      url: 'test2',
      method: 'get'
    });
    x.defaults.timeout = 1000;
    x.get('test2')
    .then(res => {
      console.log(res.data);
    })
    .catch(err => console.log(err));
  }
</script>
@endsection