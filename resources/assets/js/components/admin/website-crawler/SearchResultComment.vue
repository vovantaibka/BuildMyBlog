<template>
	<div id="search-result-comment">
		<b-card no-body
			:header="'Search for comments with entry point ' + entrypoint"
			style="max-width: 100%">
			<b-card-body>
				<b-table 
				hover 
				:items="searches"
				:fields="fields"
				>
					
				</b-table>
			</b-card-body>
		</b-card>
	</div>
</template>

<script>
export default {
	props: ['entrypoint', 'searches'],
	data: function() {
		return {
			fields: [
			{
				key: 'entrypoint',
				sortable: false,
				formatter: (value) => {
					return value.slice(0, 30) + (value.length > 30 ? "..." : "");
				}
			}
			]
		}
	}
}
</script>