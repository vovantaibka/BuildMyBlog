<template>
	<div class="container">
		<form action="{{ url('crawlersite')  }}" method="POST">
		{{ csrf_field() }}
		<div class="card">
		    <div class="card-header">
		        Start a new crawler
		    </div>
		    <div class="card-block">
		        <label for="entrypoint" class="card-title">Entry point url</label>
		        <div class="input-group">
		            <input v-model="entrypoint" type="url" class="form-control" name="entrypoint" id="entrypoint" placeholder="http://...">
		            <span class="input-group-btn">
		                <button class="btn btn-primary" type="submit">Go!</button>
		            </span>
		        </div>
		        <br>
		        <div class="form-group">
		            <label class="card-title">Resource type to find</label>
		            <br>
		            <label class="radio-inline" for="email-radio">
		                <input v-model="type" type="radio" name="type" id="email-radio" value="email" checked> Emails
		            </label>
		        </div>
		    </div>
		</div>
	    </form>
	</div>
</template>

<script>
export default {
name: ""
}
</script>

<style scoped>

</style>

