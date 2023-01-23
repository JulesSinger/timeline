<template>
  <div id="timeline-page">
    <button v-if="direction=='vertical'" class="btn btn-markup block m-auto mt-2 mb-2" @click="displayCreateForm()">Créer un item</button>
    <v-timeline id="timeline" :direction=direction  class="container">
      <v-timeline-item v-for="d in timeline_items" :key="d" :dot-color="d.dot" small>
        <template v-slot:opposite>
          {{d.date}}
        </template>
        <div :class="d.class">
          <div class="timeline-item">
            <div class="text-h6">{{d.title}}</div>
            <p>{{d.description}}</p>
          </div>
        </div>
        <div class="timeline-actions-link">
          <button @click="displayUpdateForm(d)" class="btn btn-markup timeline-link">Modifier</button>
          <button @click="call_delete_timeline_item(d.id)" class="btn btn-red timeline-link">Supprimer</button>
        </div>
      </v-timeline-item>
    </v-timeline>

    <div id="timeline-modifiers">
      
      <div id="timeline-create" class="container" modal='modal'>
        <h1>Insérer une nouvelle deadline</h1>
        <form @submit.prevent="call_post_timeline_item">
          <div class="double-form-container">
            <div class="form-container">
              <label for="title">Intitulé :</label>
              <input placeholder="intitulé de l'item" type="text" name="title" id="title" v-model="insert_form.title">
            </div>
            
            <div class="form-container">
              <label for="date">Date :</label>
              <input placeholder="yyyy-mm-dd" type="date" name="date" id="date" v-model="insert_form.date" >
            </div>

          </div>

          <div class="form-container">
              <label for="description">Description :</label>
              <input placeholder="description de l'item" type="text" name="description" id="description" v-model="insert_form.description">
          </div>

          <button type="submit" class="btn btn-markup mt-5 mr-2">Créer un nouvel item</button>
          <button v-if="direction=='vertical'" class="btn btn-red mt-5" @click="closeCreateForm()" style="width: 2rem;">X</button>
        </form>
      </div>
      <div id="timeline-update" v-if="selected_item">
        <h1>Que voulez-vous modifier ?</h1>
        <p>Vous modifier l'item : "{{ selected_item.title }}" du {{ selected_item.date }}</p>
        <form @submit.prevent="call_update_timeline_item(selected_item.id)">
          <div class="double-form-container">
            <div class="form-container">
                <label for="title">Intitulé :</label>
                <input placeholder="intitulé de l'item" type="text" name="title" id="title" v-model="update_form.title">
            </div>
            
            <div class="form-container">
              <label for="date">Date :</label>
              <input placeholder="yyyy-mm-dd" type="date" name="date" id="date" v-model="update_form.date">
            </div>
          </div>

          <div class="form-container">
              <label for="description">Description :</label>
              <input placeholder="description de l'item" type="text" name="description" id="description" v-model="update_form.description">
          </div>

          <div class="flex-center">
            <button type="submit" class="btn btn-markup mt-5 mr-2">Appliquer la modification</button>
            <div v-if="direction=='vertical'" @click="closeUpdateForm()" class="btn btn-red mt-5" style="width: 2rem;">X</div>
          </div>
        </form>
      </div>

 
    </div>
    </div>
</template>

<script setup>
import { useTimeline } from '../api/timeline.js'
import { reactive, ref, inject } from 'vue';
import { useRoute } from 'vue-router'

const route = useRoute()
const direction = screen.width < 500 ? 'vertical' : 'horizontal'

const selected_item = ref(null)
const insert_form = reactive({
    title: '',
    description: '',
    date : null,
})


let timeline_id = route.params.id
if(!timeline_id) {
  timeline_id = 1
}


const update_form = reactive({
  title: '',
  description: '',
  date : undefined,
})


const selectItem = (item) => {
  selected_item.value = item
}

const displayUpdateForm = (item) => {
  selectItem(item)
  setTimeout(() => {
    if (direction == 'vertical') {
      const timeline_update = document.getElementById('timeline-update')
      const timeline = document.getElementById('timeline')
      timeline.classList.add('black-filter')
      timeline_update.classList.toggle('active')
    }
  }, 100)

}

const toast = inject('toast')
const { timeline_items, getTimelineItems, postTimelineItem, updateTimelineItem, deleteTimelineItem } = useTimeline(insert_form, update_form, timeline_id)


const call_post_timeline_item = () => {
    postTimelineItem(() => {
        toast.success('Votre deadline à été créée avec succès !')
        window.location.reload()
    })
}

const call_update_timeline_item = (itemId) => {
  updateTimelineItem(itemId, () => {
    toast.success('Votre deadline à été modifiée avec succès !');
    window.location.reload()
  })
}

const call_delete_timeline_item = (itemId) => {
  deleteTimelineItem(itemId, () => {
    toast.success('Votre deadline à été supprimée avec succès');
    window.location.reload()
  })
}

const displayCreateForm = () => {
  const timeline_create = document.getElementById('timeline-create')
  timeline_create.classList.toggle('active')
  if (direction == 'vertical') {
    const timeline = document.getElementById('timeline')
    timeline.classList.add('black-filter')
  }
}

const closeCreateForm = () => {
  const timeline_create = document.getElementById('timeline-create')
  timeline_create.classList.toggle('active')
  if (direction == 'vertical') {
    const timeline = document.getElementById('timeline')
    timeline.classList.remove('black-filter')
  }
}

const closeUpdateForm = () => {
  const timeline_update = document.getElementById('timeline-update')
  timeline_update.classList.toggle('active')
  if (direction == 'vertical') {
    const timeline = document.getElementById('timeline')
    timeline.classList.remove('black-filter')
  }
}

getTimelineItems()

</script>