<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryApiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'photo' => $this->photo,
            'photo_white' => $this->photo_white,
            'products_count' => $this->whenCounted('productServices'), // Menggunakan whenCounted agar lebih aman

            // ================= PERUBAHAN DI SINI =================
            // Menambahkan data relasi produk ke dalam respons JSON.
            // whenLoaded() memastikan data hanya ditambahkan jika sudah dimuat oleh controller.
            // Key diubah menjadi 'products' dan 'popular_products' agar cocok dengan frontend.
            'products' => ProductApiResource::collection($this->whenLoaded('productServices')),
            'popular_products' => ProductApiResource::collection($this->whenLoaded('popularServices')),
            // ======================================================

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
