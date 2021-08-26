<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];

        for ($i=0; $i < 50000; $i++) { 
            $data[] = [
                'admin_id'      => 1,
                'brand_id'      => 1,
                'sku'           => '#ge3556g',
                'name'          => 'SAMSUNG Galaxy S21 Ultra 5G Factory Unlocked Android Cell Phone 256GB US Version Smartphone Pro-Grade Camera 8K Video 108MP High Res, Phantom Black',
                'slug'          => 'SAMSUNGGalaxyS21Ultra5GFactoryUnlockedAndroidCellPhone256GBUSVersionSmartphonePro-GradeCamera8KVideo108MPHighResPhantomBlack'.$i,
                'description'   => 'PRO-GRADE CAMERA: Zoom in close with 100X Space Zoom, and take photos and videos like a pro with our easy-to-use, multi-lens camera.
                                    SHARP 8K VIDEO: Capture your life’s best moments in head-turning, super-smooth, cinema quality 8K Video.
                                    MULTIPLE WAYS TO RECORD: Create share-ready videos and GIFs with multi-cam recording and automatic, professional-style effects.
                                    HIGHER RESOLUTION, 100X ZOOM: Get amazing clarity with a dual lens combo of 3X and 10X optical zoom and revolutionary 100X Space Zoom.
                                    ALL DAY INTELLIGENT BATTERY: Intuitively manages your cellphone’s usage, so you can go all day without charging¹.
                                    POWER OF 5G: Experience next-generation connectivity for everything you love to do: more sharing, more gaming, more experiences.
                                    ¹Battery power consumption depends on usage patterns and results may vary. Devices will work on any compatible network. Wireless voice, data and messaging services are compatible with most GSM networks such as AT&T and T-Mobile and CDMA networks such as Verizon, Sprint and US Cellular',
                'quantity'      => '50',
                'cost'          => '90000',
                'price'         => '12000',
                'featured'      => 1,
                'created_at'    => now()->toDateTimeString(),
                'updated_at'    => now()->toDateTimeString(),
            ];
        }

        $chunks = array_chunk($data, 500);
        foreach ($chunks as $chunk) {
            Product::insert($chunk);
        }
    }
}
