<template>
    <div class="profile-settings">
        <div class="avatar-ctn">
            <img src="/images/rose.svg" alt="avatar">
            <button @click="this.displayAvatar=true">Modifier l'avatar</button>
        </div>
        <form class="nom-ctn" @submit.prevent="modifyName($event)">
            <label for="nom">Modifier votre nom</label>
            <input name="nom" id="nom" type="text" placeholder="Votre nouveau nom" autocomplete="off">
            <button type="submit">Modifier votre nom</button>
        </form>
        <form class="description-ctn" @submit.prevent="modifyName($event)">
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
            <img src="/images/Beige.svg" colorCode="#FADCA8" @click="($event)=>{modifyAvatar($event); this.displayAvatar=false}"/>
            <img src="/images/Bleu.svg" colorCode="#88BBE4" @click="($event)=>{modifyAvatar($event); this.displayAvatar=false}"/>
            <img src="/images/GrisClair.svg" colorCode="#D3D3D3" @click="($event)=>{modifyAvatar($event); this.displayAvatar=false}"/>
            <img src="/images/GrisFonce.svg" colorCode="#C0C0C0" @click="($event)=>{modifyAvatar($event); this.displayAvatar=false}"/>
        </div>
        <div class="avatar-lign">
            <img src="/images/Jaune.svg" colorCode="#FFEDBC" @click="($event)=>{modifyAvatar($event); this.displayAvatar=false}"/>
            <img src="/images/Orange.svg" colorCode="#FFB272" @click="($event)=>{modifyAvatar($event); this.displayAvatar=false}"/>
            <img src="/images/Pelote.svg" colorCode="#FFFFFF" @click="($event)=>{modifyAvatar($event); this.displayAvatar=false}"/>
            <img src="/images/Rose.svg" colorCode="#FF9999" @click="($event)=>{modifyAvatar($event); this.displayAvatar=false}"/>
        </div>
    </div>
</template>

<script>
import useUsers from '../services/userservices';

export default{
    data(){
        return{
            displayAvatar: false,
        }
    },
    methods:{

    },
    setup(){
        const {updateUser} = useUsers();

            const modifyAvatar=async(e)=>{
                const avatar = (e.target.getAttribute('colorcode'));
                await updateUser('avatar', avatar);
            }

            const modifyName = async(e)=>{
                const name= e.target.querySelector('#nom').value;
                await updateUser('name', name);
            }

            const modifyPass = async(e)=>{
                const pass = e.target.querySelector('#password').value;
                const passConfirm = e.target.querySelector('#password-confirm').value;
                if(pass===passConfirm&&pass.length>=6){
                    await updateUser('password', pass);
                }
                else{
                    console.log('differents or too short');
                }
            }
        
            
        
        

        return{
            updateUser,
            modifyAvatar,
            modifyName,
            modifyPass
        }
    }
}
</script>
