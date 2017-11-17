<template>
  <div class="app">
    <ckeditor 
      v-model="content" 
      :config="config" 
      @blur="onBlur($event)" 
      @focus="onFocus($event)">
    </ckeditor>

    <button v-on:click="save">Save</button>


    <div>
    <h2>Posts</h2>
      <ul>
        <li v-for="post in posts">
          <button class="btn btn-default" v-on:click="loadPost(post)">{{ post.id }}</button>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import Ckeditor from 'vue-ckeditor2'

export default {
  components: { Ckeditor },
  mounted: function() {
      this.getContent();
  },
  data () {
    return {
      posts: [],
      content: '',
      config: {
        extraPlugins: "imagebrowser,mediaembed",
        imageBrowser_listUrl: '/api/v1/ckeditor/gallery',
        filebrowserBrowseUrl: '/api/v1/ckeditor/files',
        filebrowserImageUploadUrl: '/api/v1/ckeditor/images',
        filebrowserUploadUrl: '/api/v1/ckeditor/files',
        toolbarLocation: 'bottom',
        toolbar: [
            { name: 'basicstyles',
                items: [ 'Bold', 'Italic', 'Strike', 'Underline' ] },
            { name: 'paragraph', items: [ 'BulletedList', 'NumberedList', 'Blockquote' ] },
            { name: 'editing', items: ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
            { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
            { name: 'tools', items: [ 'SpellChecker', 'Maximize' ] },
            { name: 'clipboard', items: [ 'Undo', 'Redo' ] },
            { name: 'styles', items: [ 'Format', 'FontSize', 'TextColor', 'PasteText', 'PasteFromWord', 'RemoveFormat' ] },
            { name: 'insert', items: [ 'Image', 'MediaEmbed', 'Table', 'SpecialChar' ] },'/',
        ],
        height: 300
      }
    }
  },
  methods: {
    loadPost(post) {
        console.log(post);
        this.content = post.data;
    },
    onBlur (editor) {
      console.log(editor)
    },
    onFocus (editor) {
      console.log(editor)
    },
    getContent() {
        axios.get("/api/posts").then(results => {
          console.log("results");
          console.log(results);
          this.posts = results.data;
        }).catch(function(error) {
          console.log(error);
        })
    },
    save () {
        axios.post("/editor",{'data': this.content}).then(results => {
            this.posts.push(results.data);
        }).catch(function(error) {
            console.log(error);
        });
    }
  }
}
</script>