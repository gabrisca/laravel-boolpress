<template>
  <div class="card mb-3">
    <div class="card-body">
      <div class="d-flex justify-content-between">
        <h5 class="card-title">{{ title }}</h5>
        <span class="badge badge-warning custom-badge">{{ category }}</span>
      </div>
      <i>{{ date }}</i>
      <p class="card-text">{{ truncateText }}</p>
       <router-link class="btn btn-success" :to="{name: 'postDetail', params:{slug: slug}}">Vedi post</router-link>
    </div>
  </div>
</template>

<script>
export default {
  name: "Card",
  props: ['title', 'category', 'date', 'content', 'slug'],
 data(){
        return{
            maxTextLength:20
        }
    },
    computed:{
        truncateText(){ // creo una funzione che tronca il testo dopo 20 caratteri e aggiunge ...
            let text = this.content;
            if(text.length > this.maxTextLength){
                return text.substr(0,this.maxTextLength) + '...';
            }
            return text;
        }
    }
}
</script>

<style lang="scss">
    .custom-badge{
        display: inline-block;
        height: 2rem;
        line-height: 2rem;
    }
</style>
