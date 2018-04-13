<template>
	<b-container fluid>
		<h2>All Posts</h2>
		<div class="button-create-new">
			<b-button type="button" @click.stop="showModalCreate($event.target)" variant="primary" size="sm" class="create">
				<svg class="svg-icon" viewBox="0 0 20 20">
					<path d="M14.613,10c0,0.23-0.188,0.419-0.419,0.419H10.42v3.774c0,0.23-0.189,0.42-0.42,0.42s-0.419-0.189-0.419-0.42v-3.774H5.806c-0.23,0-0.419-0.189-0.419-0.419s0.189-0.419,0.419-0.419h3.775V5.806c0-0.23,0.189-0.419,0.419-0.419s0.42,0.189,0.42,0.419v3.775h3.774C14.425,9.581,14.613,9.77,14.613,10 M17.969,10c0,4.401-3.567,7.969-7.969,7.969c-4.402,0-7.969-3.567-7.969-7.969c0-4.402,3.567-7.969,7.969-7.969C14.401,2.031,17.969,5.598,17.969,10 M17.13,10c0-3.932-3.198-7.13-7.13-7.13S2.87,6.068,2.87,10c0,3.933,3.198,7.13,7.13,7.13S17.13,13.933,17.13,10"></path>
				</svg>
				Create Post
			</b-button>
		</div>
		<div class="table-responsive">
			<b-table striped
			hover
			:items="posts"
			:fields="fields"
			:current-page="currentPage"
			:per-page="perPage"
			>
			<template slot="actions" slot-scope="data">
				<b-button size="sm" @click.stop="showModalEdit(data.item, data.index, $event.target)" class="mr-1">
					Edit
				</b-button>
				<b-button size="sm" @click.stop="deletePost(data.item, data.index)">
					Delete
				</b-button>
			</template>
		</b-table>
	</div>
	<b-row no-gutters>
		<b-col md="4" offset-md="2" class="my-1">
			<b-pagination size="md" :total-rows="totalRows" v-model="currentPage" :per-page="perPage"></b-pagination>
		</b-col>
		<b-col md="4" class="my-1">
			<b-form-group horizontal label="Per page" class="mb-0">
				<b-form-select :options="pageOptions" v-model="perPage"></b-form-select>
			</b-form-group>
		</b-col>
	</b-row>

	<!-- Modal Create & Edit -->
	<b-modal id="modalCE"
	size="lg" 
	@shown="focusInput"
	@ok="handleOk"
	@hidden="resetModalCE"
	:title="modalCE.title"
	ok-only>
	<b-form @submit.stop.prevent="handleSubmitFormEdit">
		<b-form-group id="titleInputGroup"
		label="Title:"
		label-for="titleInput"
		description="">
			<b-form-input id="titleInput"
			type="text"
			v-model="post.title"
			required
			placeholder="Your title here">
			</b-form-input>
		</b-form-group>
		<b-form-group id="slugInputGroup"
		label="Slug:"
		label-for="slugInput"
		description="">
			<b-form-input id="slugInput"
			type="text"
			v-model="post.slug"
			required
			placeholder="Your slug here">
			</b-form-input>
		</b-form-group>
		<b-form-group id="categorySelectGroup"
		label="Category:"
		label-for="categorySelect"
		description="">
			<b-form-select id="categorySelect" v-model="post.category_id" :options="categoryOptions" class="mb-3" />
		</b-form-group>
		<b-form-group id="tagsSelectGroup"
		label="Tags:"
		label-for="tagsSelect"
		description="">
			<b-form-select id="tagsSelect" multiple :select-size="4" v-model="post.tags" :options="tagOptions" class="mb-3" />
		</b-form-group>
		
		<b-form-group id="imageGroup"
		description="">
			<b-img src="" id="post_image_tag" class=""></b-img>
			<b-form-file id="post_image" @change="changeImagePost" class="mt-3" plain></b-form-file>	 
		</b-form-group>

		<b-form-group id="contentTextareaGroup"
		label="Content post:"
		label-for="contentTextarea"
		description="">
  			<div id="contentTextarea">
  				<vue-mce :config="configEditor" ref="editor" v-model="post.body" />
  			</div>
		</b-form-group>
</b-form>
</b-modal>
</b-container>
</template>

<script>
export default {
	data: function() {
		return {
			posts: [],
			fields: [
			{
				isRowHeader: true,
				key: 'id',
				sortable: true,
				variant: 'primary'
			},
			{
				key: 'title',
				sortable: false,
				formatter: (value) => {
					return value.slice(0, 50) + (value.length > 50 ? "..." : "");
				}
			},
			{
				key: 'category.name',
				label: 'Category',
				sortable: false,
				formatter: (value) => {
					return value.slice(0, 30) + (value.length > 30 ? "..." : "");
				}
			},
			{
				key: 'created_at',
				sortable: false,
				formatter: (value) => { 
					return new Date(value).toLocaleDateString("en-US"); 
				}
			},
			{
				key: 'updated_at',
				sortable: false,
				formatter: (value) => { 
					return new Date(value).toLocaleDateString("en-US"); 
				}
			},
			{
				key: 'actions',
				label: 'Actions',
				'class': 'text-center btn-action-group'
			}
			],
			currentPage: 1,
			perPage: 5,
			totalRows: null,
			pageOptions: [5, 10, 20],
			modalCE: { title: ''},
			post: {
				title: '',
				slug: '',
				category_id: 0,
				tags: [],
				image: '',
				body: '',
			},
			categoryOptions: [
				{
					'value': 0,
					'text': 'Select category of post'
				}
			],
			tagOptions: [],
			configEditor: {
		      	theme: 'modern',
		      	fontsize_formats: "8px 10px 12px 14px 16px 18px 20px 22px 24px 26px 39px 34px 38px 42px 48px",
		      	plugins: 'print preview fullpage powerpaste searchreplace autolink',
		      	toolbar1: 'formatselect fontsizeselect | bold italic strikethrough forecolor backcolor link',
		    },
		    isCreate: false
		}
	},
	mounted() {
		var app = this;
		axios.get('/api/post')
		.then(function(refs) {
			// console.log(refs)
			app.posts = refs.data.posts
			
			var categories = refs.data.categories
			categories.forEach(function(category) {
				app.categoryOptions.push({
					value: category.id,
					text: category.name
				})
			})

			var tags = refs.data.tags
			tags.forEach(function(tag) {
				app.tagOptions.push({
					value: tag.id,
					text: tag.name
				})
			})

			app.totalRows = refs.data.posts.length
		})
		.catch(function(refs) {
			console.log(refs)
		})
	},
	methods: {
		changeImagePost(e) {
			let files = e.target.files || e.dataTransfer.files;
			if (!files.length)
				return;
			this.createImage(files[0]);
		},
		createImage(file) {
			let reader = new FileReader();
			let vm = this;
			reader.onload = (e) => {
				vm.post.image = e.target.result;
			};
			reader.readAsDataURL(file);
		},
		showModalCreate(button) {
			this.modalCE.title = 'Create Post'

			this.isCreate = true
			this.$root.$emit('bv::show::modal', 'modalCE', button)
		},
		showModalEdit(item, index, button) {

		},
		handleOk(evt) {
			evt.preventDefault()
			this.handleSubmitFormEdit(evt.target)
		},
		handleSubmitFormEdit(button) {
			var app = this
			var newPost = this.post

			if(app.isCreate) {
				axios.post('/api/post', newPost)
				.then(function(refs) {
					console.log(refs.data)
					app.posts.push(refs.data)
					app.totalRows++
				})
				.catch(function(refs) {
					console.log(refs)
				})
			}

			this.$root.$emit('bv::hide::modal', 'modalCE', button)
		},
		deletePost(item, index) {
			if(confirm("Do you really want to delete it?")) {
				var app = this
				var postId = item.id
				axios.delete('/api/post/' + postId)
					.then(function(refs) {
						app.posts.splice(((app.currentPage - 1) * app.perPage + index), 1)
						app.totalRows = app.posts.length
					})
					.catch(function(refs) {
						console.log(refs)
					}) 
			}
		},
		focusInput() {
			// this.$refs.focusThis.focus()
		},
		resetModalCE() {
		}
	}
}
</script>