 @csrf

 <div class="field mb-6">
     <label class="label text-sm mb-2 block" for="title">Title</label>
     <div class="control">
         <input type="text" type="text" class="input bg-transparent border border-muted-light rounded p-2 text-xs w-full text-black" name="title" placeholder="My next awesome project" required value="{{$project->title}}">
     </div>
 </div>

 <div class="field mb-6">
     <label class="label text-sm mb-2 block" for="description">Description </label>
     <div class="control">
         <textarea rows="5" class="input bg-transparent border border-muted-light rounded p-2 text-xs w-full text-black" name="description" id="description" placeholder="Gojek">
         {{trim($project->description)}}
         </textarea>
     </div>
 </div>

 <div class="flex items-center justify-between">
     <div class="control">
         <button class="button" type="submit">{{$buttonText}}</button>
         <a href="{{route('projects.index')}}" class="text-default no-underline">Cancel</a>
     </div>
 </div>