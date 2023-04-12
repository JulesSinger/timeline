<template>
  <div id="todolists-page" v-if="todolists">
    <h2 class="text-center mb-5 mt-2" @click="closeCreateForm()">Mes listes</h2>

    <div id="todolists-container">
      <div class="todolist undisplayed">
        <div>
          <h3>Créer une todolist</h3>
        </div>

        <div id="inputs">
          <div class="input-container">
            <input type="text" id="name" v-model="insert_form.name" placeholder="Nom de la liste"/>
          </div>

          <div class="input-container">
            <input type="text" id="description" v-model="insert_form.description" placeholder="Description de la liste"/>
          </div>

          <button class="btn btn-markup" @click="callPostTodolist()">Créer</button>
        </div>
      </div>
      <div v-for="todolist in todolists" :key="todolist.id" class="todolist" :style="{ backgroundColor: todolist.color}">
          <div class="todolist-title ">
            <h3 class="text-center">{{ todolist.name }}</h3>
          </div>
          <div class="todolist-actions">
            <router-link :to="{name: 'Todolist', params: { id: todolist.id }}" class="router">
                <img src="/images/eye.png"  alt="delete" class="icon"/>
            </router-link>
            <img src="/images/edit.png" @click="editTodolist(todolist)" />
            <img src="/images/delete.svg"  @click="callDeleteTodolist(todolist.id)" alt="delete" class="icon"/>
          </div>
      </div>

      <div class="preshow-create" @click="displayCreateForm()">
        <img src="/images/plus.svg" alt=" + " class="icon">
        <button>Liste</button>
      </div>
    </div>

    <div id="create-todolist" class="hidden">
      <div id="close">
        <div @click="closeCreateForm()">
          <img src="/images/close.png" alt="fermer" >
        </div>
      </div>

      <div id="inputs">
        <div class="input-container">
          <input type="text" id="name" v-model="insert_form.name" placeholder="nom de la todolist"/>
        </div>

        <div class="input-container">
          <input type="text" id="description" v-model="insert_form.description" placeholder="description de la todolist"/>
        </div>

        <div class="input-container">
          <input type="text" id="color" v-model="insert_form.color" placeholder="Couleur"/>
        </div>
      </div>

      <button class="btn btn-markup" @click="callPostTodolist()">AJOUTER</button>
    </div>
  </div>
</template>

<script setup>
import { useTodolist } from '../api/todolist.js'
import { reactive } from 'vue'
const { todolists, getTodolists, deleteTodolist, postTodolist } = useTodolist()
const direction = screen.width < 500 ? 'vertical' : 'horizontal'

const insert_form = reactive({
    name: '',
    description: '',
    color: ''
})


const displayCreateForm = () => {
  const todolist_create = document.getElementById('create-todolist')
  todolist_create.classList.remove('hidden')
  if (direction == 'vertical') {
    const page = document.getElementById('todolists-page')
    page.classList.add('black-filter')
  }
}

const closeCreateForm = () => {
  const todolist_create = document.getElementById('create-todolist')
  todolist_create.classList.add('hidden')
  if (direction == 'vertical') {
    const page = document.getElementById('todolists-page')
    page.classList.remove('black-filter')
  }
}


const callDeleteTodolist = (id) => {
  deleteTodolist(id)
}

const callPostTodolist = () => {
  postTodolist(insert_form)
  closeCreateForm()
}

const editTodolist = (todolist) => {
  console.log(todolist.id)
}

getTodolists()

</script>