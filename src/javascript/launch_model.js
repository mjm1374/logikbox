
class LaunchInfo {
    constructor(id, name, date, rocket, launchPad, launchPad_full_name, launchPadInfo, landingPad, landingPad_full_name, landingPadInfo, desc, pic, capsule, crew) {
        this.id = id;
        this.name = name;
        this.pic = pic;
        this.rocket = rocket;
        this.date = date;
        this.launchPad = launchPad;
        this.launchPad_full_name = launchPad_full_name;
        this.landingPad =  landingPad;
        this.landingPad_full_name = landingPad_full_name;
        this.launchPadInfo = launchPadInfo;
        this.landingPadInfo =  landingPadInfo;
        this.desc = desc;
        this.capsule = capsule;
        this.crew = crew;
    }

    setName(name){
        this.name = name;
    }

    setPic(pic){
        this.pic = pic;
    }

    setRocket(rocket){
        this.rocket = rocket;
    }

    setDate(date){
        this.date = date;
    }

    setLaunchPad(launchPad){
        this.launchPad = launchPad;
    }

    setLaunchPadFullName(full_name){
        this.launchPad_full_name = full_name;
    }

    setLandinghPad(landingPad){
        this.landingPad = landingPad;
    }

    setLandingPadFullName(full_name){
        this.landingPad_full_name = full_name;
    }

    setLaunchPadInfo(launchPadInfo){
        this.launchPadInfo = launchPadInfo;
    }

    setLandingPadInfo(landingPadInfo){
        this.landingPadInfo = landingPadInfo;
    }

    setDesc(desc){
        this.desc = desc;
    }

    setCapsule(capsule){
        this.capsule = capsule;
    }

    setCrew(crew){
        let theCrew = []
        crew.forEach(name => {
            theCrew.push(name);
        })
        this.crew = theCrew;
    }

    getCapsule(){
        return this.capsule;
    }
}