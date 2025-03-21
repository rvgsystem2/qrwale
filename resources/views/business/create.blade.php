<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($business) ? 'Edit business' : 'Create business' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">
                    {{ isset($business) ? 'Edit business' : 'Create New business' }}
                </h2>

                @if ($errors->any())
                    <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form action="{{ isset($business) ? route('business.update', $business->id) : route('business.store') }}" 
                    method="POST" enctype="multipart/form-data" class="space-y-4">
                  @csrf
                  {{-- @if(isset($business))
                      @method('PUT')
                  @endif --}}
                  <div>
                    <label class="block text-gray-700 font-medium mb-2">Custom URL</label>
                    <input type="text" name="custum_url" value="{{ old('custum_url', $business->custum_url ?? '') }}"
                        class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200">
                </div>
                
                  <div>
                      <label class="block text-gray-700 font-medium mb-2">Business Name</label>
                      <input type="text" name="bussiness_name" value="{{ old('bussiness_name', $business->bussiness_name ?? '') }}"
                          class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200" required>
                  </div>
              
                  <div>
                      <label class="block text-gray-700 font-medium mb-2">Mobile Number</label>
                      <input type="text" name="mobile_number" value="{{ old('mobile_number', $business->mobile_number ?? '') }}"
                          class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200">
                  </div>
              
                  <div>
                      <label class="block text-gray-700 font-medium mb-2">Website URL</label>
                      <input type="url" name="website_url" value="{{ old('website_url', $business->website_url ?? '') }}"
                          class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200">
                  </div>
              
                  <div>
                      <label class="block text-gray-700 font-medium mb-2">Facebook URL</label>
                      <input type="url" name="fb_url" value="{{ old('fb_url', $business->fb_url ?? '') }}"
                          class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200">
                  </div>
              
                  <div>
                      <label class="block text-gray-700 font-medium mb-2">Instagram URL</label>
                      <input type="url" name="insta_url" value="{{ old('insta_url', $business->insta_url ?? '') }}"
                          class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200">
                  </div>
              
                  <div>
                      <label class="block text-gray-700 font-medium mb-2">LinkedIn URL</label>
                      <input type="url" name="linkden_url" value="{{ old('linkden_url', $business->linkden_url ?? '') }}"
                          class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200">
                  </div>
              
                  <div>
                      <label class="block text-gray-700 font-medium mb-2">WhatsApp URL</label>
                      <input type="url" name="watsapp_url" value="{{ old('watsapp_url', $business->watsapp_url ?? '') }}"
                          class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200">
                  </div>
              
                  <div>
                      <label class="block text-gray-700 font-medium mb-2">Twitter URL</label>
                      <input type="url" name="twiter_url" value="{{ old('twiter_url', $business->twiter_url ?? '') }}"
                          class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200">
                  </div>
              
                  <div>
                      <label class="block text-gray-700 font-medium mb-2">Review URL</label>
                      <input type="url" name="review_url" value="{{ old('review_url', $business->review_url ?? '') }}"
                          class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200">
                  </div>
              
                  <div>
                      <label class="block text-gray-700 font-medium mb-2">Address</label>
                      <textarea name="address" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200">{{ old('address', $business->address ?? '') }}</textarea>
                  </div>
              
                  <div>
                      <label class="block text-gray-700 font-medium mb-2">Rating (0-5)</label>
                      <input type="number" name="rating" value="{{ old('rating', $business->rating ?? '') }}" min="0" max="5"
                          class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200">
                  </div>
              
                  <div>
                      <label class="block text-gray-700 font-medium mb-2">Upload Logo</label>
                      <input type="file" name="logo_img" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200">
                      @if(isset($business) && $business->logo_img)
                          <img src="{{ asset('storage/'.$business->logo_img) }}" alt="Business Logo" class="w-20 mt-2">
                      @endif
                  </div>
              
                  <div>
                    <label class="block text-gray-700 font-medium mb-2">Select User</label>
                    <select name="user_id" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200">
                        <option value="">Select User (Optional)</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" 
                                {{ old('user_id', $business->user_id ?? '') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                        
                    </select>
                </div>
                
                
                  <div>
                      <button type="submit" class="px-6 py-2 bg-green-500 text-white font-semibold rounded-lg hover:bg-green-600">
                          {{ isset($business) ? 'Update' : 'Submit' }}
                      </button>
                  </div>
              </form>
              
              
              
            </div>
        </div>
    </div>
</x-app-layout>
