<template>
  <div id="todolists-page" v-if="todolists">
    <div class="header mt-1">
      <router-link :to="{name: 'Home'}" class="router">
        <img src="/images/left_direction.svg"  alt="back" class="icon"/>
      </router-link>
      <h2 style="width: 100%;" class="text-center" @click="closeCreateForm() & closeUpdateForm()">Mes listes</h2>
      <p class="hidden">s</p>
    </div>

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
            <img src="/images/edit.png" @click="displayUpdateForm(todolist)" />
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

        <div class="flex" id="colors-container">
          <div class="color" id="blue" @click="setColor('insert', 'blue')">&nbsp;</div>
          <div class="color" id="red" @click="setColor('insert', 'red')">&nbsp;</div>
          <div class="color" id="green" @click="setColor('insert', 'green')">&nbsp;</div>
          <div class="color" id="yellow" @click="setColor('insert', 'yellow')">&nbsp;</div>
          <div class="color" id="grey" @click="setColor('insert', 'grey')">&nbsp;</div>

        </div>
      </div>

      <button class="btn btn-markup" @click="callPostTodolist()">AJOUTER</button>
    </div>

    <div id="edit-todolist" class="hidden">
      <div id="close">
        <div @click="closeUpdateForm()">
          <img src="/images/close.png" alt="fermer" >
        </div>
      </div>

      <div id="inputs">
        <div class="input-container">
          <input type="text" id="name" v-model="update_form.name" placeholder="nom de la todolist"/>
        </div>

        <div class="input-container">
          <input type="text" id="description" v-model="update_form.description" placeholder="description de la todolist"/>
        </div>

        <div class="flex" id="colors-container">
          <div class="color" id="blue" @click="setColor('update', 'blue')">&nbsp;</div>
          <div class="color" id="red" @click="setColor('update', 'red')">&nbsp;</div>
          <div class="color" id="green" @click="setColor('update', 'green')">&nbsp;</div>
          <div class="color" id="yellow" @click="setColor('update', 'yellow')">&nbsp;</div>
          <div class="color" id="grey" @click="setColor('update', 'grey')">&nbsp;</div>

        </div>
      </div>

      <button class="btn btn-markup" @click="callEditTodolist()">AJOUTER</button>
    </div>
  </div>
</template>

<script setup>
import { useTodolist } from '../api/todolist.js'
import { reactive, ref } from 'vue'
const { todolists, getTodolists, deleteTodolist, postTodolist, updateTodolist } = useTodolist()
const direction = screen.width < 500 ? 'vertical' : 'horizontal'

const insert_form = reactive({
    name: '',
    description: '',
    color: ''
})

const update_form = reactive({
    name: '',
    description: '',
    color: ''
})

const update_todolist = ref(null)

const setColor = (formType, color) => {
  if(formType == 'insert') {
    insert_form.color = color
  }
  else if(formType == 'update') {
    update_form.color = color
  }
}

const displayCreateForm = () => {
  const todolist_create = document.getElementById('create-todolist')
  todolist_create.classList.remove('hidden')
  if (direction == 'vertical') {
    const page = document.getElementById('todolists-page')
    page.classList.add('black-filter')
  }
}

const displayUpdateForm = (todolist) => {
  update_todolist.value = todolist
  const todolist_update = document.getElementById('edit-todolist')
  todolist_update.classList.remove('hidden')
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

const closeUpdateForm = () => {
  const todolist_update = document.getElementById('edit-todolist')
  todolist_update.classList.add('hidden')
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


const callEditTodolist = () => {
  updateTodolist(update_form, update_todolist.value.id)
  closeUpdateForm()
}

getTodolists()

</script>