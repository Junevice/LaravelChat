<template>
    <div class="profile-settings">
        <div class="avatar-ctn">
            <img :src="'/images/' + this.user.avatar.split('#')[1] + '.svg' " alt="avatar">
            <button @click="this.displayAvatar=true">Modifier l'avatar</button>
        </div>
        <form class="nom-ctn" @submit.prevent="modifyName($event)">
            <label for="nom">Modifier votre nom</label>
            <input name="nom" id="nom" type="text" placeholder="Votre nouveau nom" autocomplete="off">
            <button type="submit">Modifier votre nom</button>
        </form>
        <form class="description-ctn" @submit.prevent="modifyDescription($event)">
            <label for="description">Modifier votre description</label>
            <input name="description" id="description" type="text" placeholder="Votre nouveau description" autocomplete="off">
            <button type="submit">Modifier votre description</button>
        </form>
        <form class="password-ctn" @submit.prevent="modifyPass($event)">
            <label for="password">Modifier votre mot de passe</label>
            <input name="password" id="password" type="password" placeholder="Votre mot de passe">
            <input name="password-confirm" id="password-confirm" type="password" placeholder="Confirmer votre mot de passe">
            <button type="submit">Modifier le mot de passe</button>
        </form>
    </div>
    <div class="chooseAvatar" :class="[displayAvatar ? 'show' : '']">
        <div class="closeAvatar" @click="this.displayAvatar=false">
            <div class="crossPart tilt-right"></div>
            <div class="crossPart tilt-left"></div>
        </div>
        <h1>Choisissez votre avatar</h1>
        <div class="avatar-lign">
            <img src="/images/FADCA8.svg" colorCode="#FADCA8" @click="($event)=>{modifyAvatar($event); this.displayAvatar=false}"/>
            <img src="/images/88BBE4.svg" colorCode="#88BBE4" @click="($event)=>{modifyAvatar($event); this.displayAvatar=false}"/>
            <img src="/images/D3D3D3.svg" colorCode="#D3D3D3" @click="($event)=>{modifyAvatar($event); this.displayAvatar=false}"/>
            <img src="/images/C0C0C0.svg" colorCode="#C0C0C0" @click="($event)=>{modifyAvatar($event); this.displayAvatar=false}"/>
        </div>
        <div class="avatar-lign">
            <img src="/images/FFEDBC.svg" colorCode="#FFEDBC" @click="($event)=>{modifyAvatar($event); this.displayAvatar=false}"/>
            <img src="/images/FFB272.svg" colorCode="#FFB272" @click="($event)=>{modifyAvatar($event); this.displayAvatar=false}"/>
            <img src="/images/FFFFFF.svg" colorCode="#FFFFFF" @click="($event)=>{modifyAvatar($event); this.displayAvatar=false}"/>
            <img src="/images/FF9999.svg" colorCode="#FF9999" @click="($event)=>{modifyAvatar($event); this.displayAvatar=false}"/>
        </div>
    </div>
</template>

<script>
import useUsers from '../services/userservices';
import { createToaster } from "@meforma/vue-toaster";

export default{
    data(){
        return{
            displayAvatar: false,
        }
    },

    props: ['user'],

    methods:{

    },
    setup(){
        const toaster = createToaster({});
        const {updateUser} = useUsers();

            const modifyAvatar=async(e)=>{
                const avatar = (e.target.getAttribute('colorcode'));
                await updateUser('avatar', avatar);
                location.reload();
            }

            const modifyName = async(e)=>{
                const name= e.target.querySelector('#nom').value;
                if(name.length>=3){
                    await updateUser('name', name);
                    location.reload();
                }
                else{
                    toaster.error('Nom saisi trop court. 3 caractères minimum.')
                }
            }

            const modifyDescription = async(e)=>{
                const description = e.target.querySelector('#description').value;
                await updateUser('description ', description );
                location.reload();
            }

            const modifyPass = async(e)=>{
                const pass = e.target.querySelector('#password').value;
                const passConfirm = e.target.querySelector('#password-confirm').value;
                if(pass===passConfirm&&pass.length>=6){
                    await updateUser('password', pass);
                    location.reload();
                }
                else{
                    toaster.error('Mots de passes invalides. 6 caractères minimums.');
                }
            }
        
            
        
        

        return{
            updateUser,
            modifyAvatar,
            modifyName,
            modifyDescription,
            modifyPass
        }
    }
}
</script>
